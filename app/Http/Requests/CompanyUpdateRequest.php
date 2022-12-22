<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateRequest extends FormRequest
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
            'companyName' => 'required|string',
            'companyWeb' => 'required|url',
            'companyEmail' => 'required|email:dns',
            'companyPhone' => 'required|numeric',
            'address' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|numeric',
            'companyLogo' => 'image',
        ];
    }
}
