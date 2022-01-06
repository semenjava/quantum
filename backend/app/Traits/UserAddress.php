<?php

namespace App\Traits;

use App\Models\Companies;
use App\Models\Employees;
use App\Models\Facilities;
use App\Models\Provider;
use Modules\Address\Services\AddressService;

trait UserAddress
{
    private $userAddress;

    /**
     * @return $this
     */
    public function instanceUserAddress()
    {
        if ($this->dto->has('provider_id')) {
            $this->userAddress = Provider::find($this->dto->get('provider_id'));
        }

        if ($this->dto->has('facility_id')) {
            $this->userAddress = Facilities::find($this->dto->get('facility_id'));
        }

        if ($this->dto->has('company_id')) {
            $this->userAddress = Companies::find($this->dto->get('company_id'));
        }

        if ($this->dto->has('employee_id')) {
            $this->userAddress = Employees::find($this->dto->get('employee_id'));
        }

        return $this;
    }
}
