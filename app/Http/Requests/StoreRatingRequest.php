<?php

// app/Http/Requests/StoreRatingRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRatingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
        'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:1000',
        ];
    }
}
