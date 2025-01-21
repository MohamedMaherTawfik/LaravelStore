<?php

namespace App\Services;

use App\Http\Controllers\api\apiResponse;
use App\Http\Requests\brandRequest;
use App\Models\brands;


class brandServices
{
    use apiResponse;
    public function index()
    {
        $brand = brands::paginate(5);
        return $this->apiResponse($brand, 'All Brands', 200);
    }

    public function store(brandRequest $request)
    {
        $fields=$request->validated();
        $brand=brands::create($fields);
        return $this->apiResponse($brand, 'Brand Created Successfully', 201);
    }

    public function show()
    {
        $brand = brands::find(request('id'));
        if($brand)
        {
            return $this->apiResponse($brand, 'Brand Found Successfully', 200);
        }
        else{
            return $this->apiResponse(null, 'Brand Not Found', 404);
        }
    }

    public function update(brandRequest $request)
    {
        $fields=$request->validated();
        $brand=brands::find(request('id'));

        if($brand)
        {
            $brand->update($fields);
            return $this->apiResponse($brand, 'Brand Updated Successfully', 200);
        }
        else{
            return $this->apiResponse(null, 'Brand Not Updated', 404);
        }
    }

    public function destroy()
    {
        $brand=brands::find(request('id'));
        $brand->delete();
        if($brand)
        {
            return $this->apiResponse(null, 'Brand Deleted Successfully', 200);
        }
        else{
            return $this->apiResponse(null, 'Brand Not Deleted', 404);
        }
    }

    public function products()
    {
        $products = brands::with('products')->find(request('id'));
        if($products)
        {
            return $this->apiResponse($products, 'Brand Found Successfully', 200);
        }
        else{
            return $this->apiResponse(null, 'Brand Not Found', 404);
        }
    }
}
