<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['invoice','image','name','email','phone','address','subtotal'];

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
