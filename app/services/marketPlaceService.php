<?php

namespace App\Services;

use App\Http\Controllers\api\apiResponse;
use App\Http\Requests\marketPlaceRequest;
use App\Http\Resources\marketPlaceResource;
use App\Models\marketPlace;
use App\Repository\marketPlaceRepository;

class marketPlaceService
{
    use apiResponse;
    private $marketPlaceRepository;
    public function __construct(marketPlaceRepository $marketPlaceRepository)
    {
        $this->marketPlaceRepository = $marketPlaceRepository;
    }
    public function index()
    {
        $marketPlace = $this->marketPlaceRepository->all();
        return $this->apiResponse($marketPlace, 'All marketPlaces', 200);
    }

    public function show()
    {
        $marketPlace = $this->marketPlaceRepository->find();
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
        $fileds=$request->validated();
        $marketPlace = $this->marketPlaceRepository->create($fileds);
        return $this->apiResponse(new marketPlaceResource($marketPlace), 'marketPlace Created Successfully', 200);
    }


    public function update(marketPlaceRequest $request)
    {
        $fileds=$request->validated();
        $marketPlace = $this->marketPlaceRepository->find();
        if($marketPlace)
        {
            $marketPlace->update($fileds);
            return $this->apiResponse(new marketPlaceResource($marketPlace), 'marketPlace Updated Successfully', 200);
        }
        else{
            return $this->apiResponse(null, 'marketPlace Not Found', 404);
        }
    }

    public function destroy()
    {
        $marketPlace = $this->marketPlaceRepository->find();
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
        $products = $this->marketPlaceRepository->products();
        if($products)
        {
            return $this->apiResponse($products, 'Products Found Successfully', 200);
        }
        else{
            return $this->apiResponse(null, 'Products Not Found', 404);
        }
    }

}
