<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestStoreOrUpdateTransaksi extends FormRequest
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
            'product_id' => 'required|integer|exists:products,id',
            'qty' => 'required|integer',
        ];
    }


    public function messages()
    {
        return [
            'product_id.required' => 'Produk tidak boleh kosong!',
            'product_id.integer' => 'Produk tidak valid',
            'product_id.exists' => 'Tidak ada produk yang dimaksud',
            'qty.required' => 'Jumlah pembelian harus diisi',
            'qty.integer' => 'Jumlah pembelian harus diisi oleh anga'
        ];
    }
}
