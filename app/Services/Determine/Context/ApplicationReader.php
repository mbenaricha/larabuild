<?php

namespace App\Services\Determine\Context;

use App\Services\Determine\Commands\ReadApplicationConstantsCommand;

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


    public function __construct (string $applicationPath)
    {
        $this->rootApplicationPath = $applicationPath[-1] === '/' ? substr($applicationPath, 0, -1) : $applicationPath;

        $this->setApplications();
        $this->setInformationsByApplications();
    }

    private function setApplications (): void
    {
        $applicationFolders = scandir($this->rootApplicationPath);
        if (!$applicationFolders) {
            throw new \Exception("<< $this->rootApplicationPath >> not found!");
        }

        $applicationFolders = array_slice($applicationFolders, 2);


        $this->applications = array_values(array_filter($applicationFolders, function (string $applicationFolder) {
            return is_dir($this->rootApplicationPath . '/' . $applicationFolder);
        }));
    }

    private function setInformationsByApplications (): void
    {
        $this->informationsByApplication = [];

        foreach ($this->applications as $application) {
            $applicationPath = $this->rootApplicationPath . '/' . $application;
            $pathOfScript = __DIR__ . '/../../../php/read-application-constants.php';
            $output = [];

            exec("php $pathOfScript $applicationPath", $output);
            $data = json_decode($output[0], true);

            $this->informationsByApplication[$application] = [
                'path'      => $applicationPath,
                'variables' => $data['variables'],
                'constant'  => $data['constant'],
            ];
        }
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
}

