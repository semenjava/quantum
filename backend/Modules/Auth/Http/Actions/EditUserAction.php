<?php

namespace Modules\Auth\Http\Actions;

use App\Http\Actions\BaseAction;
use App\Properties\Property;
use Modules\Auth\Entities\User;
use App\Contract\Action;

class EditUserAction extends BaseAction implements Action
{
    /**
     * @param Property $dto
     * @return mixed
     */
    private function edit(Property $dto)
    {
        $user = User::edit($dto);
        $response = $user->toArray();
        return $response;
    }

    public function run(Property $dto)
    {
        return $this->run($dto);
    }
}
