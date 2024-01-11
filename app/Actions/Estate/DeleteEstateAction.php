<?php

namespace App\Actions\Estate;

use App\Models\Estate;
use App\Repositories\Estate\EstateRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteEstateAction
{
    use AsAction;

    public function __construct(private readonly EstateRepositoryInterface $repository)
    {
    }

    public function handle(Estate $estate)
    {
        $estate->media()->delete();
        return $this->repository->delete($estate);
    }
}
