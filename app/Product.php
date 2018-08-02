<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'category_id', 'price'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function property()
    {
        return $this->belongsToMany('App\CategoryProperty', 'product_category_property')->withPivot('value');
    }

    public function sales()
    {
        return $this->hasMany('App\Sales');
    }
}
