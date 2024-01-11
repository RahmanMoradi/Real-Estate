<?php

namespace App\Actions\User;

use App\Enums\RoleEnum;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class   StoreUserAction
{
    use AsAction;

    public function __construct(private readonly UserRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): User
    {
        return DB::transaction(function () use ($payload) {
            $user = $this->repository->store($payload);
            $user->assignRole(RoleEnum::USER->value);
            return $user;
        });
    }
}
