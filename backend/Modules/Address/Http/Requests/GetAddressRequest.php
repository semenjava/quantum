<?php

namespace Modules\Address\Http\Requests;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rules\RequiredIf;
use Modules\Address\Rules\AddressBoolRule;
use Modules\Address\Rules\StoreUserIdRule;

class GetAddressRequest extends BaseFormRequest
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
            'provider_id' => ['required_without_all:facility_id,company_id,employee_id', 'integer', new StoreUserIdRule($dto), new RequiredIf($this->provider_id == 'For providers')],
            'facility_id' => ['required_without_all:provider_id,company_id,employee_id', 'integer', new StoreUserIdRule($dto), new RequiredIf($this->facility_id == 'For facilities')],
            'company_id' => ['required_without_all:provider_id,facility_id,employee_id', 'integer', new StoreUserIdRule($dto), new RequiredIf($this->company_id == 'For companies')],
            'employee_id' => ['required_without_all:provider_id,facility_id,company_id', 'integer', new StoreUserIdRule($dto), new RequiredIf($this->employee_id == 'For employees')],
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
