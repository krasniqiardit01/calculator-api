<?php

namespace App\Http\Controllers;

use App\Models\CalculatorHistory;
use Illuminate\Http\Request;

class HistoryController
{
    public function all(Request $request){
        $history = CalculatorHistory::orderBy('created_at', 'desc')->get();
        return response()->json(['history' => $history]);
    }
}
