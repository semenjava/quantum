<?php

namespace Modules\Export\Http\Actions;

use App\Http\Actions\BaseAction;
use App\Contract\Action;
use App\Properties\Property;
use Modules\Export\Services\ExportService;

class ExportAction extends BaseAction implements Action
{
    private $service;

    public function __construct(ExportService $service)
    {
        $this->service = $service;
    }

    public function run(Property $dto)
    {
        if (\Gate::denies('export')) {
            abort(403);
        }

        $path = $this->service->setParam($dto)->run();

        return ['path' => $path];
    }
}
