<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class productRequest extends FormRequest
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
            'name' => 'required|min:3|string',
            'price' => 'required',
            'image' => 'required',
            'description' => 'required|string',
            'discount' => 'required',
            'quantity' => 'required|integer',
            'is_available' => 'required',
            'brands_id' => 'required|integer',
            'categories_id' => 'required|integer',
            'market_place_id' => 'required|integer',
        ];
    }
}
