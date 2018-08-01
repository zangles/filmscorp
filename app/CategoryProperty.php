<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryProperty extends Model
{
    protected $fillable = [
        'category_id', 'name', 'value'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
