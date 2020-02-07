<?php

require __DIR__ . '/../../vendor/autoload.php';

(new \App\Services\Determine\Context\ReadApplicationInformations($argv[1]))->run();