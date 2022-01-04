<?php

namespace Modules\Address\Rules;

use App\Properties\Property;
use Illuminate\Contracts\Validation\Rule;

class StoreUserIdRule implements Rule
{
    private $dto;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Property $dto)
    {
        $this->dto = $dto;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $ruleAttr = ['provider_id', 'facility_id', 'company_id', 'employee_id'];
        $arrAttr  = array_diff($ruleAttr, [$attribute]);

        foreach ($arrAttr as $attr) {
            if($this->dto->has($attr)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'One of the fields must be filled in provider_id, facility_id, company_id, employee_id';
    }
}
