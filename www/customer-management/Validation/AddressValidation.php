<?php

namespace CustomerManagement\Validation;

use Illuminate\Foundation\Http\FormRequest;

class AddressValidation extends FormRequest
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
            'zipcode' => 'required|max:255',
            'publicPlace' => 'required|max:255',
            'neighbordhood' => 'required|max:255',
            'complement' => 'required|max:255',
            'number' => 'required|max:255',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
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
            'zipcode.required' => 'A Zipcode is required',
            'publicPlace.required' => 'A Public Place is required',
            'neighbordhood.required' => 'A Neighbordhood is required',
            'complement.required' => 'A Complement Name is required',
            'number.required' => 'A Number is required',
            'city.required' => 'A City is required',
            'state.required' => 'A State is required',

            'zipcode.max' => 'A Zipcode max 255 characteres required.',
            'publicPlace.max' => 'A Public Place max 255 characteres required.',
            'neighbordhood.max' => 'A Neighbordhood max 255 characteres required.',
            'complement.max' => 'A Complementmax 255 characteres required.',
            'number.max' => 'A Number max 255 characteres required.',
            'city.max' => 'A City max 255 characteres required.',
            'state.max' => 'A State max 255 characteres required.',
        ];
    }
}
