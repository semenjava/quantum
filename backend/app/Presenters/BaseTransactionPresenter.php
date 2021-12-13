<?php

namespace App\Presenters;

use App\Properties\Property;

class BaseTransactionPresenter extends BasePresenter
{
    public function insertTransaction($param)
    {
        return $this->getModel()->insertGetId($param);
    }
}
