<?php

namespace app\Http\Requests\Articles;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
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
            'name' => 'string|min:1|max:255',
            'price' => 'decimal:0,2',
            'barcode' => 'string|unique:App\Models\Article,barcode',
            'category_id' => 'exists:App\Models\Category,id',
        ];
    }
}
