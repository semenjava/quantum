<?php

namespace App\Multions;

use Exception;

trait MultionTrait
{
    /**
     * @var array
     */
    private $list = [];

    /**
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * @return void
     */
    private function __wakeup()
    {
    }

    /**
     * @param string $instance
     * @return mixed
     * @throws \Exception
     * @return instance
     */
    public function getInstance(string $instance)
    {
        if(empty($this->{lcfirst($instance)})) {
            throw new Exception('Class is not loaded!');
        }

        if (empty($this->list[$instance])) $this->list[$instance] = $this->{lcfirst($instance)};

        return $this->list[$instance];
    }
}
