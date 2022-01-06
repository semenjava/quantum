<?php

namespace App\Exports;

use App\Models\Manager;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Excel;

class ManagerExport implements FromArray, ShouldAutoSize
{
    /**
     * @var Manager::all()
     */
    private $managers;

    /**
     * @var mixed|string
     */
    private $writerType = Excel::XLS;

    /**
     * @var type = 'Xls' or 'Csv'
     * @param $users
     * @param $type
     */
    public function __construct($managers, $type = 'Xls')
    {
        $this->managers = $managers;
        $this->writerType = $type;
    }

    /**
     * @return array
     */
    public function array(): array
    {
        return $this->managers->toArray();
    }
}
