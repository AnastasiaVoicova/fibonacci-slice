<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FibonacciRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'from' => 'required|integer|min:0|lt:to',
            'to' => 'required|integer|gt:from'
        ];
    }
}
