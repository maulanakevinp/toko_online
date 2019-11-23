<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['invoice','image','name','email','phone','address','subtotal','verify','reason','status'];

    public function products()
    {
        return $this->belongsToMany('App\Product','order_product')
                    ->withPivot('qty')
                    ->withPivot('rating')
                    ->withPivot('review')
                    ->withPivot('order_product_id')
                    ->withTimestamps();
    }

    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct');
    }
}
