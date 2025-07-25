<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
class UpdateCategoryRequest extends FormRequest
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
      $category = $this->route('category')?? $this->route('id');

      return [
        // 'name_en' => ['required', 'string', 'max:90',Rule::unique('categories','name->en')->ignore($category->id)],
        // 'name_ar' => ['required', 'string', 'max:90',Rule::unique('categories','name->ar')->ignore($category->id)],
        'description_en' => ['nullable', 'string', 'max:255'],
        'description_ar' => ['nullable', 'string', 'max:255'],

      ];
    }
}
