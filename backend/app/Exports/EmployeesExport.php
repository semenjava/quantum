<?php

namespace App\Exports;

use App\Models\Employees;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Excel;

class EmployeesExport implements FromArray, ShouldAutoSize
{
    /**
     * @var Employees:all()
     */
    private $employees;

    /**
     * @var mixed|string
     */
    private $writerType = Excel::XLS;

    /**
     * @var type = 'Xls' or 'Csv'
     * @param $users
     * @param $type
     */
    public function __construct($employees, $type = 'Xls')
    {
        $this->employees = $employees;
        $this->writerType = $type;
    }

    /**
     * @return array
     */
    public function array(): array
    {
        return $this->employees->toArray();
    }
}
