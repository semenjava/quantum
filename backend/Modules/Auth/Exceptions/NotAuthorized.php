<?php

namespace Modules\Auth\Exceptions;

class NotAuthorized extends \Exception
{
    public function __construct($message = "Unauthenticated")
    {
        parent::__construct($message, 403);
    }
}
