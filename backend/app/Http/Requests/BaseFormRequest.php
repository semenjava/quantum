<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use App\Properties\Property;
use Illuminate\Validation\ValidationException;

abstract class BaseFormRequest extends FormRequest
{
    protected $param;

    public function valid(array $param): BaseFormRequest
    {
        $validator = Validator::make($param, $this->rules());
        if($validator->fails()){
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        $this->param = $param;

        return $this;
    }

    public function toDto(): Property
    {
        $this->param['user'] = $this->getUser();
        return new Property($this->param);
    }
}
