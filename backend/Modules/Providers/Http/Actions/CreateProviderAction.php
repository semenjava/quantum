<?php

namespace Modules\Providers\Http\Actions;

use App\Http\Actions\BaseAction;
use App\Contract\Action;
use App\Properties\Property;
use Modules\Providers\Services\ProviderService;

class CreateProviderAction extends BaseAction implements Action
{
    public function run(Property $dto)
    {
        if (\Gate::denies('create-provider')) {
            abort(403);
        }

        $service = new ProviderService($dto);
        $service->createProvider();

        return [
            'success' => true,
            'message' => 'Create Provider'
        ];
    }
}
