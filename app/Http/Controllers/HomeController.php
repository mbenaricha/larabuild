<?php

namespace App\Http\Controllers;

use App\Services\Determine\Context\ApplicationReader;

class HomeController extends Controller
{
    public function index ()
    {
        $applicationReader = new ApplicationReader(__DIR__ . '/../../../tests/fixtures/appli');
        $informationsByApplication = $applicationReader->getInformationsByApplication();

        return view('home.index', compact('informationsByApplication'));
    }
}
