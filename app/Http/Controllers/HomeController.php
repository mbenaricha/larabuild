<?php

namespace App\Http\Controllers;

use App\Services\Determine\Context\ApplicationReader;

class HomeController extends Controller
{
    public function index ()
    {
//        $applicationPath = __DIR__ . '/../../../tests/fixtures/appli';
        $applicationPath = '/var/www/fullCore/html/appli';
        $applicationReader = new ApplicationReader($applicationPath);
        $informationsByApplication = $applicationReader->getInformationsByApplication();

        return view('home.index', compact('informationsByApplication'));
    }
}
