<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['invoice','name','email','phone','address','subtotal'];

    public function orderDetail()
    {
        return $this->belongsToMany('App\OrderDetail');
    }
}
