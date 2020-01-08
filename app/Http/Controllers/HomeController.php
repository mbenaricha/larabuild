<?php

namespace App\Http\Controllers;

use App\Services\Determine\Context\ApplicationReader;
use Illuminate\Http\RedirectResponse;

class HomeController extends Controller
{
    /**
     * @var ApplicationReader
     */
    private $applicationReader;

    public function __construct (ApplicationReader $applicationReader)
    {
        $this->applicationReader = $applicationReader;
    }

    public function index ()
    {
        return redirect()->route('home.constants');
    }

    public function constants ()
    {
        $informationsByApplication = $this->applicationReader->getInformationsByApplication();
        return view('home.constants', compact('informationsByApplication'));
    }

    public function variables ()
    {
        $informationsByApplication = $this->applicationReader->getInformationsByApplication();
        return view('home.variables', compact('informationsByApplication'));
    }

    public function resetCache ()
    {
        $this->applicationReader->resetCache();
        $redirectUrl = url()->previous() !== route('home.reset-cache') ? url()->previous() : route('home.variables');
        return redirect($redirectUrl);
    }
}
