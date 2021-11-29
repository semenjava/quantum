<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use App\Properties\Property;
use Illuminate\Validation\ValidationException;

abstract class BaseFormRequest extends FormRequest
{
    protected $param;

    public function valid(array $param): Property
    {
        $validator = Validator::make($param, $this->rules());
        if($validator->fails()){
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        return $this->createProperty($param);
    }

    private function createProperty($param)
    {
        $dto = new Property($param);
        return $dto;
    }
}
