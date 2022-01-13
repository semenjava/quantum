<?php

namespace Modules\Auth\Http\Actions;

use App\Contract\Action;
use App\Http\Actions\BaseAction;
use App\Properties\Property;
use Modules\Auth\Services\UserService;

class GetProviderAction extends BaseAction implements Action
{
    /**
     * @var UserService
     */
    private $service;

    /**
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function run(Property $dto)
    {
        if (\Gate::denies('read-provider')) {
            abort(403);
        }

        $data = $this->service->getProvider($dto->all());
        $items = $data->items();
        $response['data'] = collect($items)->toArray();
        $response['paginatorInfo'] = [
            'total' => $data->total(),
            'currentPage' => $data->currentPage(),
            'lastPage' => $data->lastPage(),
            'perPage' => $data->perPage(),
        ];

        activity()->performedOn(request()->user())
            ->causedBy(request()->user())
            ->withProperties(['user_id' => request()->user()->id, 'param' => $dto->toJson()])
            ->log('Get Provider list');

        return $response;
    }
}
