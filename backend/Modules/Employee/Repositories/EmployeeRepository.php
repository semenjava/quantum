<?php

namespace Modules\Employee\Repositories;

use App\Models\Facilities;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\Employees;

class EmployeeRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Employees::class;
    }

    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return parent::create($data);
    }
}
