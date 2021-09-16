<?php

namespace App\Http\Controllers;

use App\Jobs\ImportOrderInCSV;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function makeorderreport()
    {
        ImportOrderInCSV::dispatch();
    }
}
