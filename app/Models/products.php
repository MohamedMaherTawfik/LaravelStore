<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'name',
        'image',
        'price',
        'description',
        'discount',
        'quantity',
        'is_available',
        'brands_id',
        'categories_id',
        'market_place_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function categories()
    {
        return $this->belongsTo(categories::class, 'categories_id');
    }

    public function brands()
    {
        return $this->belongsTo(brands::class, 'brands_id');
    }

    public function marketPlace()
    {
        return $this->belongsTo(marketPlace::class, 'market_place_id');
    }

    public function cartItems()
    {
        return $this->belongsToMany(cartItems::class, 'products_id');
    }

}
