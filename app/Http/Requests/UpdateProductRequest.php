<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'product_code_id' => 'sometimes|exists:product_codes,id',
            'pharmacy_id' => 'sometimes|exists:pharmacies,id',
            'name' => 'required|string|max:255',
            'price' => 'sometimes|numeric|min:0',
            'tax_rate' => 'sometimes|numeric|min:0',
            'is_featured' => 'sometimes|boolean',
            'is_active' => 'sometimes|boolean',
            'min_stock' => 'sometimes|integer|min:0',
            'quantity' => 'sometimes|integer|min:0',
            'batch_number' => 'sometimes|string|max:255',
            'storage_conditions' => 'nullable|string',
            'prescription_required' => 'sometimes|boolean',
            'production_date' => 'nullable|date',
            'expiry_date' => 'nullable|date|after:production_date',
            'images' => 'nullable|array',
            'images.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
}