<?php

require __DIR__ . '/../../vendor/autoload.php';

['variables' => $variables, 'constants' => $constants] = (new \App\Services\Determine\Context\ReadApplicationInformations($argv[1]))->getInformations();

//... on regarde si y'a des filtres pour renvoyer $informations filtrée
if (isset($argv[2])) {
    //TODO
}

echo json_encode(compact('variables', 'constants'));
