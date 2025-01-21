<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order_items extends Model
{
    protected $table = 'order_items';
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['orders_id', 'products_id', 'quantity', 'price'];

    public function order()
    {
        return $this->belongsTo(orders::class, 'orders_id');
    }

    public function product()
    {
        return $this->belongsTo(products::class, 'products_id');
    }
}
