<?php

namespace App\Repository;

use App\Models\brands;

class BrandRepository
{
    private $brand;
    public function __construct(brands $brand)
    {
        $this->brand = $brand;
    }

    public function create($data)
    {
        return $this->brand::create($data);
    }

    public function update($data)
    {
        return $this->brand::where('id', request('id'))->update($data);
    }

    public function delete()
    {
        return $this->brand::where('id', request('id'))->delete();
    }

    public function all()
    {
        return $this->brand::all();
    }

    public function find()
    {
        return $this->brand::find(request('id'));
    }

    public function products()
    {
        return $this->brand::with('products')->find(request('id'));
    }

}
