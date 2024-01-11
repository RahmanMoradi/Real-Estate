<?php

namespace App\Actions\Fav;

use App\Models\Fav;
use App\Repositories\Fav\FavRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class AddFav
{
    use AsAction;

    public function __construct(private readonly FavRepositoryInterface $repository)
    {
    }

    public function handle(Fav $model): bool
    {
        return DB::transaction(function () use ($model) {
            $model->fav();
            return true;
        });
    }
}
