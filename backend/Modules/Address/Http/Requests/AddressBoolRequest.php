<?php

namespace Modules\Address\Http\Requests;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rules\RequiredIf;
use Modules\Address\Rules\AddressBoolRule;
use Modules\Address\Rules\StoreUserIdRule;

class AddressBoolRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $dto = $this->toDto();

        return [
            'postal_address'   => ['array', new AddressBoolRule($dto)],
            'office_address'   => ['array', new AddressBoolRule($dto)],
            'billing_address'  => ['array', new AddressBoolRule($dto)],
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
