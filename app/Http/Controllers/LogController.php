<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogController extends Controller
{
    public function log (Request $request) {
        Log::emergency('My log');

        return response()->json();

    }
}
