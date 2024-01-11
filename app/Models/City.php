<?php

namespace App\Models;

use App\Traits\HasEstate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory, HasEstate;

    protected $fillable = ['name'];

}
