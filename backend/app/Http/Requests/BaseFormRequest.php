<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use App\Properties\Property;
use Illuminate\Validation\ValidationException;

abstract class BaseFormRequest extends FormRequest
{
    /**
     * @var $param
     */
    protected $param;

    /**
     * @param array $param
     * @return $this
     */
    public function valid(array $param): BaseFormRequest
    {
        $this->param = $param;

        $validator = Validator::make($param, $this->rules());
        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        return $this;
    }

    /**
     * @return Property
     */
    public function toDto(): Property
    {
        $this->param['user'] = $this->getUser();
        return new Property($this->param);
    }
}
