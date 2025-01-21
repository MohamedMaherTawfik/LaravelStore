<?php

namespace App\Services;

use App\Http\Controllers\api\apiResponse;
use App\Http\Requests\marketPlaceRequest;
use App\Http\Resources\marketPlaceResource;
use App\Models\marketPlace;

class marketPlaceService
{
    use apiResponse;
    public function index()
    {
        $marketPlace = marketPlace::paginate(5);
        return $this->apiResponse($marketPlace, 'All marketPlaces', 200);
    }

    public function show()
    {
        $marketPlace = marketPlace::find(request('id'));
        if($marketPlace)
        {
            return $this->apiResponse(new marketPlaceResource($marketPlace), 'marketPlace Found Successfully', 200);
        }
        else{
            return $this->apiResponse(null, 'marketPlace Not Found', 404);
        }
    }

    public function store(marketPlaceRequest $request)
    {
        $request->validated();
        $marketPlace = marketPlace::create(request()->all());
        return $this->apiResponse(new marketPlaceResource($marketPlace), 'marketPlace Created Successfully', 200);
    }


    public function update(marketPlaceRequest $request)
    {
        $request->validated();
        $marketPlace = marketPlace::find(request('id'));
        if($marketPlace)
        {
            $marketPlace->update(request()->all());
            return $this->apiResponse(new marketPlaceResource($marketPlace), 'marketPlace Updated Successfully', 200);
        }
        else{
            return $this->apiResponse(null, 'marketPlace Not Found', 404);
        }
    }

    public function destroy()
    {
        $marketPlace = marketPlace::find(request('id'));
        if($marketPlace)
        {
            $marketPlace->delete();
            return $this->apiResponse(null, 'marketPlace Deleted Successfully', 200);
        }
        else{
            return $this->apiResponse(null, 'marketPlace Not Found', 404);
        }
    }

    public function products()
    {
        $products = marketPlace::with('products')->find(request('id'));
        if($products)
        {
            return $this->apiResponse($products, 'Products Found Successfully', 200);
        }
        else{
            return $this->apiResponse(null, 'Products Not Found', 404);
        }
    }

}
