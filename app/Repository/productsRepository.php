<?php

namespace App\Repository;

use App\Models\products;

class productsRepository
{
    private $products;
    public function __construct(products $products)
    {
        $this->products = $products;
    }

    public function all()
    {
        return $this->products->all();
    }

    public function create($data)
    {
        return $this->products::create($data);
    }

    public function update($data)
    {
        return $this->products::where('id', request('id'))->update($data);
    }

    public function delete()
    {
        return $this->products::where('id', request('id'))->delete();
    }

    public function find()
    {
        return $this->products::find(request('id'));
    }

}
