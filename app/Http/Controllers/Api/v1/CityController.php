<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\City\DeleteCityAction;
use App\Actions\City\StoreCityAction;
use App\Actions\City\UpdateCityAction;
use App\Http\Requests\City\StoreCityRequest;
use App\Http\Requests\City\UpdateCityRequest;
use App\Http\Resources\CityResource;
use App\Models\City;
use App\Repositories\City\CityRepositoryInterface;

class CityController extends ApiBaseController
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(CityRepositoryInterface $repository)
    {
        if(isset(request()->most_estate)){
            return $this->successResponse(
                $repository->query()
                    ->withCount("estates")
                    ->orderByDesc("estates_count")
                    ->limit(3)
                ->get(),
                "تعداد خانه",
            );
        }
        return $this->successResponse(
            CityResource::collection($repository->paginate()),
            "تمامی خانه ها"
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCityRequest $request)
    {
        $this->authorize("create", City::class);
        $model = StoreCityAction::run($request->validated());
        if ($model) {
            return $this->successResponse(CityResource::make(
                $model->load('user', 'category', 'translations')),
                "show",
            );
        } else {
            return $this->errorResponse(
                "کاربران سایت تنها میتوانند ۲ خانه اضافه کنند"
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(City $estate)
    {
        return $this->successResponse(
            CityResource::make($estate->load(['user', 'city','category'])),
            "خانه به شرح زیر است"
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCityRequest $request, City $estate)
    {
        $this->authorize("update", $estate);
        $data = UpdateCityAction::run($estate, $request->validated());
        return $this->successResponse(
            CityResource::make($data),
            "خانه با موفقیت تغییر یافت!"
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $estate)
    {
        $this->authorize("delete", $estate);
        DeleteCityAction::run($estate);
        return $this->successResponse(
            "",
            "خانه با موفقیت حذف شد!"
        );
    }
}
