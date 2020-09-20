<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use Translatable;
    protected $with = ['translations'];
    protected $fillable = ['slug'];
    protected $translatedAttributes = ['name'];
    protected $casts = [
        'is_active' => 'boolean',
    ];


    public function getActive()
    {
        return $this->is_active == 1 ? 'مفعل' : 'غير مفعل';
    }

    public function scopeActiveTags($query)
    {
        return $query->where('is_active',1);
    }

}
