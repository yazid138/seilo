<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'required|string',
            'phone' => 'required|numeric',
            'birth_date' => 'required|date',
            'gender' => 'required|string',
            'about_me' => 'required|string',
            'foto' => 'image',
            'address' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|numeric',
            'tingkat_pendidikan' => 'required|string',
            'institusi' => 'required|string',
            'jurusan' => 'required|string',
            'nilai_akhir' => 'required|numeric',
            'tanggal_masuk' => 'required|date',
            'tanggal_lulus' => 'required|date',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'linkedin' => 'nullable|string',
        ];
    }
}
