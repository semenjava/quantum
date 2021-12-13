<?php

namespace App\Presenters;

use Illuminate\Database\Eloquent\Model;

class BasePresenter extends Presenter
{
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }
}
