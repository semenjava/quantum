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
     * @param string $instance
     * @return mixed
     * @throws \Exception
     * @return instance
     */
    public function getInstance(string $instance)
    {
        if (empty($this->{lcfirst($instance)})) {
            throw new Exception('Class is not loaded!');
        }

        if (empty($this->list[$instance])) {
            $this->list[$instance] = $this->{lcfirst($instance)};
        }

        return $this->list[$instance];
    }
}
