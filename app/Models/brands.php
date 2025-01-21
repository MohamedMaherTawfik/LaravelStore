<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class brands extends Model
{
    protected $table = 'brands';

    protected $fillable = [
        'name',
    ];
    protected $hidden = [

    ];

    public function products()
    {
        return $this->hasMany(products::class);
    }
}
