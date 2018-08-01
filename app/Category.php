<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function product()
    {
        return $this->hasOne('App\Product');
    }

    public function property()
    {
        return $this->hasMany('App\CategoryProperty');
    }
}
