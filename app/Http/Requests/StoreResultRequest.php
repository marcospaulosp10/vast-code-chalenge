<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResultRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'passage_id' => 'required|exists:passages,id',
            'name'        => 'nullable|string|max:100',
            'wpm'        => 'required|numeric|min:1|max:300',
            'accuracy'   => 'required|numeric|min:0|max:100',
            'duration_ms'=> 'required|integer|min:5000',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
