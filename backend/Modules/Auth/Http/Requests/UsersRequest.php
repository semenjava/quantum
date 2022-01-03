<?php

namespace Modules\Auth\Http\Requests;

use App\Http\Requests\BaseFormRequest;

class UsersRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'search' => 'string',
            'sort' => 'array',
            'first' => 'required|integer',
            'page' => 'required|integer'
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
