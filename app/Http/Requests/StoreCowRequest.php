<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCowRequest extends FormRequest
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
            'price'       => ['nullable', 'integer'],
            'category_id' => ['nullable'],
            'tag'         => ['nullable'],
            'caste'       => ['nullable'],
            'weight'      => ['nullable'],
            'transport'   => ['nullable'],
            'hasil'       => ['nullable'],
            'color'       => ['nullable'],
            'buy_date'    => ['nullable'],
        ];
    }
}