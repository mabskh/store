<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use Translatable;
    protected $with = ['translations'];
    protected $fillable = ['is_active' , 'photo'];
    protected $translatedAttributes = ['name'];
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function create(array $except)
    {
    }

    public function getActive()
    {
        return $this->is_active == 1 ? 'مفعل' : 'غير مفعل';
    }

    public function getPhotoAttribute($val)
    {
        return ($val !== null) ? asset('assets/images/brands/' . $val) : '' ;
    }

    public function scopeActiveBrands($query)
    {
        return $query->where('is_active',1);
    }



}
