<?php

namespace Modules\Auth\Http\Actions;

use App\Http\Actions\BaseAction;
use App\Properties\Property;
use Modules\Auth\Services\UserService;

class UsersAction extends BaseAction
{
    private UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Property $dto
     * @return string[]
     */
    public function users(Property $dto)
    {
        $response = [];

        $data = $this->service->users($dto->toArray());
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
            ->log('Get user list');

        return $response;
    }
}
