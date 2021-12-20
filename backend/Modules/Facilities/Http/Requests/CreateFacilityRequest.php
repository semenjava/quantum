<?php

namespace Modules\Facilities\Http\Requests;

use App\Http\Requests\BaseFormRequest;
use App\Models\User;

class CreateFacilityRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'country' => 'required|string',
            'region' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            'postal' => 'required|string',
            'email' => 'required|string|email|max:255|regex:/[-0-9a-zA-Z.+]+@[-0-9a-zA-Z.+]+.[a-zA-Z]{2,4}/|unique:users',
            'password' => ['min:8','max:25', User::PASSWORD_REGEX],
            'c_password' => 'same:password',
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
