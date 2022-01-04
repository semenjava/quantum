<?php

namespace Modules\Auth\Http\Requests;

use App\Http\Requests\BaseFormRequest;
use App\Models\User;

class EditUserRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'integer',
            'name' => 'string',
            'email' => 'string|email|max:255|regex:/[-0-9a-zA-Z.+]+@[-0-9a-zA-Z.+]+.[a-zA-Z]{2,4}/',
            'role' => 'required|string',
            'time_zone' => 'string'
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
