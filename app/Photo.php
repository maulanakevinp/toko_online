<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'photo1';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['photo1', 'photo2', 'photo3', 'photo4', 'photo5', 'photo6'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    public function company()
    {
        return $this->hasOne('App\Company');
    }

    public function product()
    {
        return $this->hasMany('App\Product');
    }
}
