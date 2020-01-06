<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Determine\Context\ApplicationReader;

class ApplicationReaderController extends Controller
{
    public function index (ApplicationReader $applicationReader)
    {
        return $applicationReader->getInformationsByApplication();
    }
}
