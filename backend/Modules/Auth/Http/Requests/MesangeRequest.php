<?php

namespace Modules\Auth\Http\Requests;

use App\Http\Requests\BaseFormRequest;

class MesangeRequest extends  BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mess' => 'required|string|max:1000'
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