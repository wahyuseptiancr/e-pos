<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestStoreOrUpdateProducts extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'type_product' => 'required|max:255',
        ];
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'name.required' => 'Nama produk harus diisi',
            'name.max' => 'Nama produk maksimal 255 karakter',
            'description.required' => 'Deskripsi produk harus diisi',
            'description.max' => 'Deskripsi produk maksimal 255 karakter',
            'price.required' => 'Harga produk harus diisi',
            'price.integer' => 'Harga produk harus berupa angka',
            'stock.required' => 'Stok produk harus diisi',
            'stock.integer' => 'Stok produk harus berupa angka',
            'type_product.required' => 'Tipe produk harus diisi',
            'type_product.max' => 'Tipe produk maksimal 255 karakter',
        ];
    }
}
