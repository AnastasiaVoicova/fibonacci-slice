<?php

namespace App\Http\Controllers;

use App\Http\Requests\FibonacciRequest;
use App\Modules\Fibonacci\Services\FibonacciSlicer;
use Illuminate\Contracts\View\View;

class FibonacciController extends Controller
{

    public function fibonacciSlice(FibonacciRequest $request, FibonacciSlicer $slicer): View
    {
        $params = $request->validated();
        $from = $params['from'];
        $to = $params['to'];

        return view('fibonacci', ['data' => $slicer->getSlice($from, $to)]);
    }
}

