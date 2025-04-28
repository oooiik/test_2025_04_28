<?php

namespace App\Http\Requests\Products;

use App\Rules\EAN13Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'barcode' => ['string', 'unique:App\Models\Product,barcode', new EAN13Rule()],
            'category_id' => 'required|exists:App\Models\Category,id',
        ];
    }
}
