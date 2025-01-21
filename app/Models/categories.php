<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    protected $fillable = [
        'name',
        'image'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function products()
    {
        return $this->hasMany(products::class);
    }
}
