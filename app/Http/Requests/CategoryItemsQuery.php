<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryItemsQuery extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'page' => ['sometimes','integer','min:1'],
            'per_page' => ['sometimes','integer','min:1','max:50'],
            'q' => ['sometimes','string','max:255'],
            'min_price' => ['sometimes','numeric','gte:0'],
            'max_price' => ['sometimes','numeric','gte:min_price'],
            'sort' => ['sometimes','in:price_asc,price_desc,name_asc,name_desc'],
        ];
    }
}
