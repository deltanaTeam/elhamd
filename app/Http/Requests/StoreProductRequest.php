<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            // 'product_code_id' => 'nullable|exists:product_codes,id',
            'name' => 'required|string|max:255',
            'pharmacy_id' => 'required|exists:pharmacies,id',
            'price' => 'required|numeric|min:0',
            'tax_rate' => 'required|numeric|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'min_stock' => 'integer|min:0',
            'quantity' => 'integer|min:0',
            'batch_number' => 'required|string|max:255',
            'storage_conditions' => 'nullable|string',
            'prescription_required' => 'boolean',
            'production_date' => 'nullable|date',
            'expiry_date' => 'nullable|date|after:production_date',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
}