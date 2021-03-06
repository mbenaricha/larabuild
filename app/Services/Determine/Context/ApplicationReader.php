<?php

namespace App\Services\Determine\Context;


use Psr\SimpleCache\CacheInterface;

class ApplicationReader
{
    /**
     * @var string
     */
    private $rootApplicationPath;
    /**
     * @var string[]
     */
    private $applications;
    /**
     * @var string[]
     */
    private $informationsByApplication;
    /**
     * @var CacheRepository
     */
    private $cache;


    public function __construct (string $applicationPath, CacheInterface $cache)
    {
        $this->rootApplicationPath = realpath($applicationPath[-1] === '/' ? substr($applicationPath, 0, -1) : $applicationPath);
        if ($this->rootApplicationPath === false) {
            throw new \Exception("<< $applicationPath >> is not a valid folder!");
        }

        $this->cache = $cache;

        $this->setApplications();
        $this->setInformationsByApplication();
    }

    private function setApplications (): void
    {
        if ($this->cache->has($this->rootApplicationPath)) {
            $this->applications = array_keys($this->cache->get($this->rootApplicationPath));
            return;
        }

        $applicationFolders = scandir($this->rootApplicationPath);
        if (!$applicationFolders) {
            throw new \Exception("<< $this->rootApplicationPath >> not found!");
        }

        $applicationFolders = array_slice($applicationFolders, 2);

        $this->applications = array_values(array_filter($applicationFolders, function (string $applicationFolder) {
            return is_dir($this->rootApplicationPath . '/' . $applicationFolder);
        }));
    }

    private function setInformationsByApplication (): void
    {
        if ($this->cache->has($this->rootApplicationPath)) {
            $this->informationsByApplication = $this->cache->get($this->rootApplicationPath);
            return;
        }

        $this->informationsByApplication = [];

        foreach ($this->applications as $application) {
            $applicationPath = $this->rootApplicationPath . '/' . $application;
            $pathOfScript = __DIR__ . '/../../../php/read-application-constants.php';
            $output = [];

            exec("php $pathOfScript $applicationPath", $output);
            ['variables' => $variables, 'constants' => $constants] = json_decode($output[count($output) - 1], true);

            $this->informationsByApplication[$application] = [
                'path'      => $applicationPath,
                'variables' => $variables,
                'constants' => $constants,
            ];
        }

        $this->cache->set($this->rootApplicationPath, $this->informationsByApplication);
    }

    /**
     * @return string[]
     */
    public function getInformationsByApplication (): array
    {
        return $this->informationsByApplication;
    }

    /**
     * @return string[]
     */
    public function getApplications (): array
    {
        return $this->applications;
    }

    public function resetCache (): void
    {
        $this->cache->forget($this->rootApplicationPath);
    }

    /**
     * @return string
     */
    public function getRootApplicationPath (): string
    {
        return $this->rootApplicationPath;
    }
}
