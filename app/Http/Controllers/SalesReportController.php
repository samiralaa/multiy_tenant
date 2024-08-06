<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesReportController extends Controller
{

    public function showData()
    {
        return $this->getData(); // Calls the getData method from the base Controller class
    }
    
}
