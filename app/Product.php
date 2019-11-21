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
    protected $fillable = ['name', 'type_id', 'price', 'bukalapak', 'tokopedia', 'olx', 'description','specification'];

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
    
    public function orderDetail()
    {
        return $this->belongsToMany('App\OrderDetail');
    }
}
