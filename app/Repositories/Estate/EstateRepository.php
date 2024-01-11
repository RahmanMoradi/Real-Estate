<?php

namespace App\Repositories\Estate;


use App\Models\Estate;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class EstateRepository extends BaseRepository implements EstateRepositoryInterface
{
    public function __construct(Estate $model)
    {
        parent::__construct($model);
    }

    public function getModel(): Estate
    {
        return parent::getModel();
    }

    public function query(array $payload = []): Builder|QueryBuilder
    {
        return QueryBuilder::for(Estate::class)
            ->with("city", "user", "category")
            ->allowedFilters(
                "has_warehouse",
                "type",
                AllowedFilter::callback("city", function (Builder $query, $city){
                    $query->whereHas("city", function ($query) use ($city){
                        $query->where("name", $city);
                    });
                }),
                AllowedFilter::callback("meterage", function (Builder $query, $min, $max){
                    $query->whereBetween("meterage", $min, $max);
                }),
                AllowedFilter::callback("priceBigger", function (Builder $query, $min){
                    $query->where("price", ">", $min);
                }),
                AllowedFilter::callback("only_trashed", function (Builder $query, $bool){
                    $query->onlyTrashed();
                }),
                AllowedFilter::callback("has_comment", function (Builder $query, $bool){
                    $query->whereHas("comments");
                }),
                AllowedFilter::callback("commentsBigger", function (Builder $query, $min){
                    $query->withCount("comments")->where("comments_count", ">", $min);
                }),
                AllowedFilter::callback("tag", function (Builder $query, $tag){
                    $query->whereHas("tags", function (Builder $query) use ($tag){
                        $query->where("name", json_encode(["en"=> $tag]));
                    });
                }),
            )
            ;
    }


}
