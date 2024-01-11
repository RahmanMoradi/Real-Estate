<?php

namespace App\Actions\Estate;

use App\Models\Estate;
use App\Repositories\Estate\EstateRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateEstateAction
{
    use AsAction;

    public function __construct(private readonly EstateRepositoryInterface $repository)
    {
    }

    public function handle(Estate $estate, $payload)
    {
        $payload["user_id"] = auth()->id();
        $estate = $this->repository->update($estate,$payload);
        if(request()->hasFile('media')){
            $estate->media()->delete();
            $estate->addMediaFromRequest('media')
                ->toMediaCollection('estate');
        }
        return $estate;
    }
}
