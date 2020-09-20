<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class BrandTranslation extends Model
{
    protected $fillable = ['name'];

    public $timestamps = false;
}
