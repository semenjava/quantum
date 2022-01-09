<?php

namespace Modules\Company\Http\Actions;

use App\Contract\Action;
use App\Http\Actions\BaseAction;
use App\Properties\Property;
use Modules\Company\Services\CompanyService;

class CreateCompanyAction extends BaseAction implements Action
{
    /**
     * @var CompanyService
     */
    private $companyService;

    /**
     * @param CompanyService $service
     */
    public function __construct(CompanyService $service)
    {
        $this->companyService = $service;
    }

    public function run(Property $dto)
    {
        if (\Gate::denies('create-company')) {
            abort(403);
        }

        return $this->companyService->setParam($dto)->createCompany();
    }
}
