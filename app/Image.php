<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id', 'product_id', 'image'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function company()
    {
        return $this->belongsTo('App\Company');
    }
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
