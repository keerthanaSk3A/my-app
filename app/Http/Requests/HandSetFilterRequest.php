<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HandSetFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'brand' => 'sometimes|nullable',
            'min_price' => 'sometimes|min:0',
            'max_price' => 'sometimes|min:0',
            'features' => 'sometimes|array',
            'features.*' => 'string',
            'search_item' => 'sometimes',
            'page' => 'sometimes|integer|min:1',
        ];
    }
}
