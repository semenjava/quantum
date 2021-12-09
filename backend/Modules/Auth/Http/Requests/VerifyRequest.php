<?php

namespace Modules\Auth\Http\Requests;

use App\Http\Requests\BaseFormRequest;

class VerifyRequest extends  BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'expires' => 'required|string',
            'hash' => 'required|string',
            'id' => 'required',
            'signature' => 'required|string',
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
