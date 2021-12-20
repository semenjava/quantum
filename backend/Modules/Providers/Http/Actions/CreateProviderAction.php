<?php

namespace Modules\Providers\Http\Actions;

use App\Http\Actions\BaseAction;
use App\Contract\Action;
use App\Properties\Property;
use Modules\Providers\Services\ProviderService;

class CreateProviderAction extends BaseAction implements Action
{
    private $providerService;

    public function __construct(ProviderService $service)
    {
        $this->providerService = $service;
    }


    public function run(Property $dto)
    {
        if (\Gate::denies('create-provider')) {
            abort(403);
        }

        $this->providerService->setParam($dto)->createProvider();

        return [
            'success' => true,
            'message' => 'Create Provider'
        ];
    }
}
