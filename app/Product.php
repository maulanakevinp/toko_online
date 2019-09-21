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
    protected $fillable = ['name', 'type_id', 'photo1', 'price', 'bukalapak', 'tokopedia', 'olx', 'description'];

    public function photo()
    {
        return $this->belongsTo('App\Photo');
    }

    public function type()
    {
        return $this->belongsTo('App\Type');
    }

    public function category($id)
    {
        return DB::table('products')
            ->select(
                'products.id as id',
                'products.name as name',
                'products.type_id as type_id',
                'types.type as type',
                'types.category_id as category_id',
                'categories.category as category',
                'products.price as price',
                'products.photo1 as photo1',
                'products.bukalapak as bukalapak',
                'products.tokopedia as tokopedia',
                'products.olx as olx',
                'products.description as description'
            )
            ->join('types', 'types.id', '=', 'products.type_id')
            ->join('categories', 'categories.id', '=', 'types.category_id')
            ->where('category_id', '=', $id)
            ->paginate(15);
    }

    public function product($id)
    {
        return DB::table('products')
            ->select(
                'products.id as id',
                'products.name as name',
                'products.type_id as type_id',
                'types.type as type',
                'types.category_id as category_id',
                'categories.category as category',
                'products.photo1 as photo1',
                'photos.photo2 as photo2',
                'photos.photo3 as photo3',
                'photos.photo4 as photo4',
                'photos.photo5 as photo5',
                'photos.photo6 as photo6',
                'products.price as price',
                'products.bukalapak as bukalapak',
                'products.tokopedia as tokopedia',
                'products.olx as olx',
                'products.description as description'
            )
            ->join('photos', 'photos.photo1', '=', 'products.photo1')
            ->join('types', 'types.id', '=', 'products.type_id')
            ->join('categories', 'categories.id', '=', 'types.category_id')
            ->where('products.id', '=', $id)
            ->first();
    }
}
