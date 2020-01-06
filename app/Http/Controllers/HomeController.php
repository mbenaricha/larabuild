<?php

namespace App\Http\Controllers;

use App\Services\Determine\Context\ApplicationReader;

class HomeController extends Controller
{
    public function index (ApplicationReader $applicationReader)
    {
        $informationsByApplication = $applicationReader->getInformationsByApplication();
        return view('home.index', compact('informationsByApplication'));
    }
}
