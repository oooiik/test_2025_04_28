<?php

namespace app\Http\Requests\Articles;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
            'name' => 'required|string|min:1|max:255',
            'price' => 'required|decimal:0,2',
            'barcode' => 'string|unique:App\Models\Article,barcode',
            'category_id' => 'required|exists:App\Models\Category,id',
        ];
    }
}
