<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $productId = $this->route('product');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'name')->ignore($productId),
            ],
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0.01',
            'stock_quantity' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome do produto é obrigatório.',
            'name.unique' => 'Já existe um produto com este nome.',
            'price.required' => 'O preço é obrigatório.',
            'price.min' => 'O preço deve ser maior que zero.',
            'stock_quantity.min' => 'A quantidade em estoque não pode ser negativa.',
            'stock_quantity.required' => 'A quantidade em estoque é obrigatória.',
        ];
    }
}
