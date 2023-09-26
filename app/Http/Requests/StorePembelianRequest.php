<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePembelianRequest extends FormRequest
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
                'kode_pembelian' => 'required',
                'kode_masuk' => 'required',
                'tanggal_masuk' => 'required',
                'total' => 'required',
                'pemasok_id' => 'required',
                'user_id' => 'required'
        ];
    }
    public function messages(){
        return [
            'kode_pembelian.required' => 'kode pembelian belum diisi!',
            'kode_masuk.required' => 'kode masuk belum diisi!',
            'tanggal_masuk.required' => 'kode pembelian belum diisi!',
            'total.required' => 'kode pembelian belum diisi!',
            'pemasok_id.required' => 'kode pembelian belum diisi!',
            'user_id.required' => 'kode pembelian belum diisi!'
        ];
    }
}
