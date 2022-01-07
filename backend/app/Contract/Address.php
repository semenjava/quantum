<?php

namespace App\Contract;

interface Address
{
    public function address($address_id);
    public function addresses();
}
