<?php

namespace App\Services\Determine\Context;

class ReadApplicationInformations
{
    /**
     * @var string
     */
    private $applicationPath;
    /**
     * @var string[]
     */
    private $definePaths;

    public function __construct (string $applicationPath)
    {
        $this->applicationPath = $applicationPath;
        if (!is_dir($this->applicationPath)) {
            throw new \Exception("<< $applicationPath >> is not a directory");
        }
        $this->definePaths = ['version.inc', 'config.inc', 'dbstruct.inc', 'setup_entry.inc'];
    }

    public function run ()
    {
        include __DIR__ . '/../Context/emulationOfLegacyEnvironment/declarationOfClassesOrFunctions.php';
        include __DIR__ . '/../Context/emulationOfLegacyEnvironment/version.inc';

        $variables = $this->includeDefinePathsAndGetVariables();

        echo json_encode([
            'variables' => $variables,
            'constants' => $this->getConstants(),
        ]);
    }

    private function includeDefinePathsAndGetVariables (): array
    {
        $__isApplicationFolder = false;
        include_once(__DIR__ . '/../Context/emulationOfLegacyEnvironment/declarationOfGlobalVariables.php');
        foreach ($this->definePaths as $__definePath) {
            if (file_exists($this->applicationPath . '/' . $__definePath)) {
                $__isApplicationFolder = true;
                include($this->applicationPath . '/' . $__definePath);
            }
        }

        if (!$__isApplicationFolder) {
            throw new \Exception("<< $this->applicationPath >> is not a application folder");
        }

        $variables = get_defined_vars();
        $this->deleteKeys(['^__definePath', '^__isApplicationFolder'], $variables);
        return $variables;
    }

    private function getConstants (): array
    {
        $constants = get_defined_constants(true)['user'] ?? [];
        $this->deleteKeys(['^U_IDNA', '^IDNA_', '_IDNA_'], $constants);
        return $constants;
    }

    /**
     * @param array $regexes
     * @param array $array
     */
    private function deleteKeys (array $regexes, array &$array)
    {
        foreach ($array as $key => $value) {
            foreach ($regexes as $regex) {
                if (preg_match("/$regex/", $key)) {
                    unset($array[$key]);
                }
            }
        }
    }
}
