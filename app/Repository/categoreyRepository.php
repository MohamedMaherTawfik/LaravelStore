<?php

namespace App\Repository;

use App\Models\categories;

class categoreyRepository
{
    private $categories;
    public function __construct(categories $category)
    {
        $this->categories = $category;
    }

    public function all()
    {
        return $this->categories->all();
    }

    public function create($data)
    {
        return $this->categories::create($data);
    }

    public function update($data)
    {
        return $this->categories::where('id', request('id'))->update($data);
    }

    public function delete()
    {
        return $this->categories::where('id', request('id'))->delete();
    }

    public function find()
    {
        return $this->categories::find(request('id'));
    }

    public function products()
    {
        return $this->categories::with('products')->find(request('id'));
    }
}
