<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\Estate\DeleteEstateAction;
use App\Actions\Estate\StoreEstateAction;
use App\Actions\Estate\UpdateEstateAction;
use App\Http\Requests\Estate\StoreEstateRequest;
use App\Http\Requests\Estate\UpdateEstateRequest;
use App\Http\Resources\EstateResource;
use App\Models\Estate;
use App\Repositories\Estate\EstateRepositoryInterface;

class EstateController extends ApiBaseController
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(EstateRepositoryInterface $repository)
    {
        if(isset(request()->count)){
            return $this->successResponse(
                $repository->query()->get()->count(),
                "تعداد خانه",
            );
        }
        return $this->successResponse(
            EstateResource::collection($repository->paginate()),
            "تمامی خانه ها"
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEstateRequest $request)
    {
        $this->authorize("create", Estate::class);
        $model = StoreEstateAction::run($request->validated());
        if ($model) {
            return $this->successResponse(EstateResource::make(
                $model->load('user', 'category')),
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
    public function show(Estate $estate)
    {
        return $this->successResponse(
            EstateResource::make($estate->load(['user', 'city','category', "comments"])),
            "خانه به شرح زیر است"
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEstateRequest $request, Estate $estate)
    {
        $this->authorize("update", $estate);
        $data = UpdateEstateAction::run($estate, $request->validated());
        return $this->successResponse(
            EstateResource::make($data),
            "خانه با موفقیت تغییر یافت!"
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estate $estate)
    {
        $this->authorize("delete", $estate);
        DeleteEstateAction::run($estate);
        return $this->successResponse(
            "",
            "خانه با موفقیت حذف شد!"
            );
    }
}
