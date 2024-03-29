<?php

namespace App\Repositories\Category;


use App\Models\Category;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function getModel(): Category
    {
        return parent::getModel();
    }

    public function query(array $payload = []): Builder|QueryBuilder
    {

        return QueryBuilder::for($this->model)
            ->allowedFilters([
                'published',
                AllowedFilter::scope('with_relations'),
            ]); // Execute the query and return the result
    }


}
