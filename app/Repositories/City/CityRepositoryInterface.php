<?php

namespace App\Repositories\City;

use App\Repositories\BaseRepositoryInterface;
use App\Models\City;

interface CityRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): City;


}
