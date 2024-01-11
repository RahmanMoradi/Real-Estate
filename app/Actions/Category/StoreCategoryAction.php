<?php

namespace App\Actions\Category;

use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreCategoryAction
{
    use AsAction;

    private readonly Category $category;

    public function __construct(private readonly CategoryRepositoryInterface $repository, Category $category)
    {
        $this->category = $category;
    }

    public function handle(array $payload): Category|null
    {
        return DB::transaction(function () use ($payload) {
            if (!empty($payload['parent_id'])) {
                $categoryType = $this->repository->find($payload['parent_id']);
                if ($payload['type'] == $categoryType->type) {
                    return $this->repository->store($payload);
                }
            } else {
                return $this->repository->store($payload);
            }
            return null;
        });
    }
}
