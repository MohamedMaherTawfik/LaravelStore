<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class marketPlace extends Model
{
    protected $table = 'market_places';
    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function products()
    {
        return $this->hasMany(products::class);
    }
}
