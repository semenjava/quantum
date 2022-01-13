<?php

namespace Modules\Company\Repositories;

use App\Models\Companies;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class CompanyRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Companies::class;
    }

    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return parent::create($data);
    }
}
