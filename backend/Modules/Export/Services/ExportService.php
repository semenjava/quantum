<?php

namespace Modules\Export\Services;

use App\Exports\UsersExport;
use App\Services\BaseService;
use Modules\Export\Multions\UserMultion;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Export\Repositories\UserRepository;
use Illuminate\Http\File;

class ExportService extends BaseService
{
    public const MODEL = "model";
    public const PARAM = "param";
    public const FORMAT = "format";
    public const URL_DOWNLOAD = "/download/";

    /**
     * @var UserMultion
     */
    private $multion;

    /**
     * @param UserMultion $multion
     */
    public function __construct(UserMultion $multion)
    {
        $this->multion = $multion;
    }

    /**
     * @UserRepository $repository
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        $model = $this->dto->getUcfirst(self::MODEL);
        $param = $this->dto->get(self::PARAM);
        $format = $this->dto->getUcfirst(self::FORMAT);

        $repository = $this->multion->getInstance($model.'Repository');

        $users = $repository->queryAll($param, $model);

        $export = $this->multion->instanceUserExport($users, $format);

        $nameFile = $this->dto->getLcfirst(self::MODEL).'.'.$this->dto->getLcfirst(self::FORMAT);
        $file = Excel::download($export, $nameFile);
        $fileName = $file->getFile()->getFilename();
        $path = env('APP_URL').':'.env('FORWARD_WEB_PORT').self::URL_DOWNLOAD.$fileName;

        return $path;
    }
}
