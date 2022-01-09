<?php

namespace Modules\Employee\Http\Requests;

use App\Http\Requests\BaseFormRequest;
use App\Models\User;

class CreateEmployeeRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string',
            'surname' => 'required|string',
            'last_name' => 'string',
            'company_id' => 'required',
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
