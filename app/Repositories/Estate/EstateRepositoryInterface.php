<?php

namespace App\Repositories\Estate;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Estate;

interface EstateRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Estate;


}
