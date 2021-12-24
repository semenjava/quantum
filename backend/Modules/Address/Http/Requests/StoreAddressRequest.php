<?php

namespace Modules\Address\Http\Requests;

use App\Http\Requests\BaseFormRequest;

class StoreAddressRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'provider_id' => 'required',
            'address_line_1' => 'required|string',
            'address_line_2' => 'string',
            'country' => 'string',
            'state' => 'string',
            'city' => 'string',
            'postal' => 'string',
            'postal_address' => 'boolean',
            'primary_address' => 'boolean',
            'billing_address' => 'boolean'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
