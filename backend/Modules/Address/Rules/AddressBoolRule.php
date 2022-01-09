<?php

namespace Modules\Address\Rules;

use App\Models\Companies;
use App\Models\Employees;
use App\Models\Facilities;
use App\Models\Provider;
use App\Properties\Property;
use App\Repositories\LocationRepository;
use Illuminate\Contracts\Validation\Rule;
use App\Traits\UserAddress;

class AddressBoolRule implements Rule
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
        if ($this->dto->count($attribute) > 1) {
            return false;
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
        return 'The :attribute there can only be one address';
    }
}
