<?php

namespace App\Http\Controllers;

use App\Models\CalculatorHistory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use \App\Classes\Calculator;

class CalculatorController extends BaseController
{
    public function calculate(Request $request) {
        $formula = $request->post('formula');
        $result = Calculator::calculate($request->post('formula'));

        $calculatorHistory = new CalculatorHistory;
        $calculatorHistory->formula = $formula;
        $calculatorHistory->result = $result;
        $calculatorHistory->save();

        $history = CalculatorHistory::orderBy('created_at', 'desc')->get();

        return response()->json(['result' => $result, 'history' => $history]);
    }
}
