<?php

namespace Modules\Address\Http\Requests;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rules\RequiredIf;
use Modules\Address\Rules\StoreUserIdRule;

class StoreAddressRequest extends BaseFormRequest
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
            'address_line_1' => 'required|string',
            'address_line_2' => 'string',
            'country' => 'string',
            'state' => 'string',
            'city' => 'string',
            'postal' => 'string',
            'postal_address' => 'boolean',
            'office_address' => 'boolean',
            'billing_address' => 'boolean'
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
