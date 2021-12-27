<?php

namespace App\Exports;

use App\Models\Facilities;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Excel;

class FacilityExport implements FromArray, ShouldAutoSize
{
    /**
     * @var Facilities:all()
     */
    private $facilities;

    /**
     * @var mixed|string
     */
    private $writerType = Excel::XLS;

    /**
     * @var type = 'Xls' or 'Csv'
     * @param $users
     * @param $type
     */
    public function __construct($facilities, $type = 'Xls')
    {
        $this->facilities = $facilities;
        $this->writerType = $type;
    }

    /**
     * @return array
     */
    public function array(): array
    {
        return $this->facilities->toArray();
    }
}
