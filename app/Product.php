<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'stock', 'type_id', 'price', 'bukalapak', 'tokopedia', 'olx', 'description','specification'];

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function type()
    {
        return $this->belongsTo('App\Type');
    }
    
    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }

    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct');
    }
}
