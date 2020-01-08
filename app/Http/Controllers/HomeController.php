<?php

namespace App\Http\Controllers;

use App\Services\Determine\Context\ApplicationReader;

class HomeController extends Controller
{
  public function constantViewer (ApplicationReader $applicationReader)
  {
      $informationsByApplication = $applicationReader->getInformationsByApplication();
      return view('home.constant-viewer', compact('informationsByApplication'));
  }

  public function varViewer (ApplicationReader $applicationReader)
  {
      $informationsByApplication = $applicationReader->getInformationsByApplication();
      return view('home.var-viewer', compact('informationsByApplication'));
  }
}
