<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleSearchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'keyword' => ['string', 'nullable'],
            'date' => ['date', 'date_format:Y-m-d', 'nullable'],
            'category' => ['string', 'nullable'],
            'source' => ['string', 'nullable'],
        ];
    }
}
