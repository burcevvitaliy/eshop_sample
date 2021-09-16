<?php

namespace App\Http\Controllers\Shop;

use App\Jobs\ImportOrderInCSV;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function makeorderreport()
    {
        ImportOrderInCSV::dispatch();
        return response()->json(['status' => true, 'message' => 'ok', 'result' => []]);
    }
}
