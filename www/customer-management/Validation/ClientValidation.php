<?php

namespace CustomerManagement\Validation;

use Illuminate\Foundation\Http\FormRequest;

class ClientValidation extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'companyName' => 'required|max:255',
            'cnpj' => 'required|max:255',
            'telephone' => 'required|min:12|max:15',
            'responsibleName' => 'required|max:255',
            'email' => 'required|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'companyName.required' => 'A Company Name is required',
            'cnpj.required' => 'A CNPJ is required',
            'telephone.required' => 'A Telephone is required',
            'responsibleName.required' => 'A Responsible Name is required',
            'email.required' => 'A E-mail is required',

            'telephone.min' => 'A Telephone min 12 characteres required.',
            'telephone.max' => 'A Telephone max 15 characteres required.',
        ];
    }
}
