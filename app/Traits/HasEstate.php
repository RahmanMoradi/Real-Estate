<?php

namespace App\Traits;

use App\Models\Estate;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasEstate
{
    public function estates(): HasMany
    {
        return $this->hasMany(Estate::class);
    }
}
