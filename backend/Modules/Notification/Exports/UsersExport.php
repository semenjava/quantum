<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Excel;

class UsersExport implements FromArray, ShouldAutoSize
{
    /**
     * @var User::all()
     */
    private $users;

    /**
     * @var mixed|string
     */
    private $writerType = Excel::XLS;

    /**
     * @var type = 'Xls' or 'Csv'
     * @param $users
     * @param $type
     */
    public function __construct($users, $type = 'Xls')
    {
        $this->users = $users;
        $this->writerType = $type;
    }

    /**
     * @return array
     */
    public function array(): array
    {
        return $this->users->toArray();
    }
}
