<?php

namespace App\Contract;

use App\Properties\Property;

interface Action
{
    public function run(Property $dto);
}
