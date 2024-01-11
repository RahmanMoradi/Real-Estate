<?php

namespace App\Actions\Estate;

use App\Enums\RoleEnum;
use App\Models\Estate;
use App\Repositories\Estate\EstateRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreEstateAction
{
    use AsAction;

    public function __construct(private readonly EstateRepositoryInterface $repository)
    {
    }

    public function handle($payload): Estate | bool
    {
        return DB::transaction(function () use ($payload){
            $payload["user_id"] = auth()->id();
            if (request()->user()->hasAnyRole(RoleEnum::ADMIN->value, RoleEnum::AGENCY->value)) {
                $estate =  $this->repository->store($payload);
                if (request()->hasFile('media')) {
                    $estate->addMediaFromRequest('media')
                        ->toMediaCollection('estate');
                }
                return $estate;
            }
            else if(request()->user()->hasRole(RoleEnum::USER->value) && request()->user()->estates->count() < 2){
                $estate = $this->repository->store($payload);
                if (request()->hasFile('media')) {
                    $estate->addMediaFromRequest('media')
                        ->toMediaCollection('estate');
                }
                return $estate;
            }
            return false;
        });
    }
}
