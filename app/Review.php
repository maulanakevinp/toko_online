<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['rating', 'title', 'name', 'description'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

}
