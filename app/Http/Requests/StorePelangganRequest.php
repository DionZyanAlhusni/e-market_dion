<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePelangganRequest extends FormRequest
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
            'nama_pelanggan'=> 'required|max:50|string',
            'kode_pelanggan'=> 'required|integer',
            'alamat'=> 'required|max:200|string',
            'no_telp'=> 'required|integer',
            'email'=> 'required|max:255|string'
        ];
    }

    public function messages(){
        return [
            'kode_pelanggan.required' => 'Data kode pelanggan harus diisi!',
            'nama_pelanggan.required' => 'Data nama pelanggan harus diisi!',
            'alamat.required' => 'Data nama pelanggan harus diisi!',
            'no_telp.required' => 'Data nama pelanggan harus diisi!',
            'email.required' => 'Data nama pelanggan harus diisi!'
        ];
    }
}
