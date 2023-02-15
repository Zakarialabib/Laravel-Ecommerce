<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            '*.name' => 'required|string',
            '*.price' => 'required|numeric',
            '*.code' => 'required',
            '*.quantity' => 'nullable',
            '*.categoryId' => 'nullable|exists:categories,id',
        ];
    }

    protected function prepareForValidation()
    {
        $data = []; 

        foreach($this->toArray() as $obj)
        {
            $obj['category_id'] = $obj['categoryId'] ?? null;
            $data[] = $obj;
        }

    }
}
