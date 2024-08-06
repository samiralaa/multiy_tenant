<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryReportController extends Controller
{
    public function index()
    {
        return view('reports.inventory');
    }

    public function export(Request $request)
    {
        return (new InventoryReport($request))->download('inventory-report.xlsx');
    }

    public function print(Request $request)
    {
        return (new InventoryReport($request))->stream('inventory-report.pdf');
    }


}
