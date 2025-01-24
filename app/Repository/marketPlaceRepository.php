<?php

namespace App\Repository;

use App\Models\marketPlace;

class marketPlaceRepository
{
    private $marketPlace;
    public function __construct(marketPlace $marketPlace)
    {
        $this->marketPlace = $marketPlace;
    }

    public function all()
    {
        return $this->marketPlace->all();
    }

    public function create($data)
    {
        return $this->marketPlace::create($data);
    }

    public function update($data)
    {
        return $this->marketPlace::where('id', request('id'))->update($data);
    }

    public function delete()
    {
        return $this->marketPlace::where('id', request('id'))->delete();
    }

    public function find()
    {
        return $this->marketPlace::find(request('id'));
    }

    public function products()
    {
        return $this->marketPlace::with('products')->find(request('id'));
    }


}
