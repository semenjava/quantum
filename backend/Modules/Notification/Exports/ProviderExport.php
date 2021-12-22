<?php

namespace App\Exports;

use App\Models\Providers;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Excel;

class ProviderExport implements FromArray, ShouldAutoSize
{
    /**
     * @var Providers::all()
     */
    private $providers;

    /**
     * @var mixed|string
     */
    private $writerType = Excel::XLS;

    /**
     * @var type = 'Xls' or 'Csv'
     * @param $users
     * @param $type
     */
    public function __construct($providers, $type = 'Xls')
    {
        $this->providers = $providers;
        $this->writerType = $type;
    }

    /**
     * @return array
     */
    public function array(): array
    {
        return $this->providers->toArray();
    }
}
