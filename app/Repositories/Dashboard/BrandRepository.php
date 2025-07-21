<?php

namespace App\Repositories\Dashboard;

use App\Interfaces\Dashboard\BrandRepositoryInterface;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Model;

class BrandRepository extends CrudRepository implements BrandRepositoryInterface
{
    protected Model $model;

    public function __construct(Brand $model)
    {
        $this->model = $model;
    }
}
