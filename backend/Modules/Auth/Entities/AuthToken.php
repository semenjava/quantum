<?php

namespace Modules\Auth\Entities;

class AuthToken
{
    public $token = null;

    public function __construct($token)
    {
        $this->token = $token;
    }
}
