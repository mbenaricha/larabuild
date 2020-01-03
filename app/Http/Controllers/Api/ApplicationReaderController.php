<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Determine\Context\ApplicationReader;
use Illuminate\Http\Request;

class ApplicationReaderController extends Controller
{
    public function index ()
    {
        $applicationReader = new ApplicationReader(__DIR__ . '/../../../../tests/fixtures/appli');
        $informationsByApplication = $applicationReader->getInformationsByApplication();

        return $informationsByApplication;
    }
}
