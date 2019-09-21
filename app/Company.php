<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'bukalapak', 'tokopedia', 'olx', 'whatsapp', 'line', 'address', 'phone_number', 'whatsapp_number', 'email', 'maps', 'testimonial', 'photo1'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function photo()
    {
        return $this->belongsTo('App\Photo');
    }
}
