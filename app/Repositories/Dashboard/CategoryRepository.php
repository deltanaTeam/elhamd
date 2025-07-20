<?php

namespace App\Repositories\Dashboard;

use App\Interfaces\Dashboard\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\CrudRepository;

class CategoryRepository extends CrudRepository implements CategoryRepositoryInterface
{
    protected Model $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }
}
