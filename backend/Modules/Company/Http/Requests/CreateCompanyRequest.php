<?php

namespace Modules\Company\Http\Requests;

use App\Http\Requests\BaseFormRequest;
use App\Models\User;

class CreateCompanyRequest extends BaseFormRequest
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
            'email' => 'required|string|email|max:255|regex:/[-0-9a-zA-Z.+]+@[-0-9a-zA-Z.+]+.[a-zA-Z]{2,4}/|unique:users',
            'password' => ['min:8','max:25', User::PASSWORD_REGEX],
            'c_password' => 'same:password',
            'phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'fax' => 'min:10',
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
