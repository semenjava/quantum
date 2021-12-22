<?php

namespace App\Repositories;

abstract class BaseRepository
{
    /**
     * @return BaseRepository
     */
    abstract public static function init();
}
