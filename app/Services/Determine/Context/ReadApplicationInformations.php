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
        $this->definePaths = ['version.inc', 'config.inc', 'dbstruct.inc', 'setup_entry.inc'];
    }

    private function includeDefinePathsAndGetVariables (): array
    {
        foreach ($this->definePaths as $__definePath) {
            if (file_exists($this->applicationPath . '/' . $__definePath)) {
                include($this->applicationPath . '/' . $__definePath);
            }
        }

        $variables = get_defined_vars();
        $this->deleteKeys(['__definePath'], $variables);

        return $variables;
    }

    private function deleteKeys (array $keys, array &$array)
    {
        foreach ($keys as $key) {
            unset($array[$key]);
        }
    }

    private function getConstant (): array
    {
        $definedConstant = get_defined_constants(true)['user'] ?? [];

        $this->deleteKeys(['LARAVEL_START', 'CURLOPT_HTTPHEADER', 'CURLOPT_RETURNTRANSFER', 'CURLOPT_BINARYTRANSFER',
            'CURLOPT_SSL_VERIFYPEER', 'CURLOPT_SSL_VERIFYHOST', 'U_IDNA_PROHIBITED_ERROR', 'U_IDNA_ERROR_START',
            'U_IDNA_UNASSIGNED_ERROR', 'U_IDNA_CHECK_BIDI_ERROR', 'U_IDNA_STD3_ASCII_RULES_ERROR',
            'U_IDNA_ACE_PREFIX_ERROR', 'U_IDNA_VERIFICATION_ERROR', 'U_IDNA_LABEL_TOO_LONG_ERROR',
            'U_IDNA_ZERO_LENGTH_LABEL_ERROR', 'U_IDNA_DOMAIN_NAME_TOO_LONG_ERROR', 'U_IDNA_ERROR_LIMIT',
            'U_STRINGPREP_PROHIBITED_ERROR', 'U_STRINGPREP_UNASSIGNED_ERROR', 'U_STRINGPREP_CHECK_BIDI_ERROR',
            'IDNA_DEFAULT', 'IDNA_ALLOW_UNASSIGNED', 'IDNA_USE_STD3_RULES', 'IDNA_CHECK_BIDI',
            'IDNA_CHECK_CONTEXTJ', 'IDNA_NONTRANSITIONAL_TO_ASCII', 'IDNA_NONTRANSITIONAL_TO_UNICODE',
            'INTL_IDNA_VARIANT_2003', 'INTL_IDNA_VARIANT_UTS46', 'IDNA_ERROR_EMPTY_LABEL',
            'IDNA_ERROR_LABEL_TOO_LONG', 'IDNA_ERROR_DOMAIN_NAME_TOO_LONG', 'IDNA_ERROR_LEADING_HYPHEN',
            'IDNA_ERROR_TRAILING_HYPHEN', 'IDNA_ERROR_HYPHEN_3_4', 'IDNA_ERROR_LEADING_COMBINING_MARK',
            'IDNA_ERROR_DISALLOWED', 'IDNA_ERROR_PUNYCODE', 'IDNA_ERROR_LABEL_HAS_DOT',
            'IDNA_ERROR_INVALID_ACE_LABEL', 'IDNA_ERROR_BIDI', 'IDNA_ERROR_CONTEXTJ'], $definedConstant);

        return $definedConstant;
    }

    public function run ()
    {
        include __DIR__ . '/../Context/emulationOfLegacyEnvironment/declarationOfGlobalVariables.php';
        include __DIR__ . '/../Context/emulationOfLegacyEnvironment/declarationOfClassesOrFunctions.php';
        include __DIR__ . '/../Context/emulationOfLegacyEnvironment/version.inc';

        $variables = $this->includeDefinePathsAndGetVariables();

        echo json_encode([
            'variables' => $variables,
            'constant'  => $this->getConstant(),
        ]);
    }
}
