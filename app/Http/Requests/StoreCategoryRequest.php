<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
class StoreCategoryRequest extends FormRequest
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
          'name_en' => ['required', 'string', 'max:100','unique:categories,name->en'],
          'name_ar' => ['required', 'string', 'max:100','unique:categories,name->ar'],
          'description_en' => ['nullable', 'string', 'max:255'],
          'description_ar' => ['nullable', 'string', 'max:255'],
          'parent_id' => ['nullable', 'exists:categories,id'],
        ];
    }
}
