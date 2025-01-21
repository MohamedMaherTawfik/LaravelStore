<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    protected $table = 'orders';
    protected $hidden = [];
    protected $fillable = [
        'user_id',
        'location',
        'total',
        'status',
        'details',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order_items()
    {
        return $this->hasMany(order_items::class);
    }
}
