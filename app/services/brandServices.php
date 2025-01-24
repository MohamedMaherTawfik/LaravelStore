<?php

namespace App\Services;

use App\Http\Controllers\api\apiResponse;
use App\Http\Requests\brandRequest;
use App\Models\brands;
use App\Repository\BrandRepository;


class brandServices
{
    use apiResponse;
    private $brandRepository;
    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }
    public function index()
    {
        $brand = $this->brandRepository->all();
        return $this->apiResponse($brand, 'All Brands', 200);
    }

    public function store(brandRequest $request)
    {
        $fields=$request->validated();
        $brand=$this->brandRepository->create($fields);
        return $this->apiResponse($brand, 'Brand Created Successfully', 201);
    }

    public function show()
    {
        $brand = $this->brandRepository->find();
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
        $brand=$this->brandRepository->find();

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
        $brand=$this->brandRepository->find();
        if($brand)
        {
            $this->brandRepository->delete();
            return $this->apiResponse(null, 'Brand Deleted Successfully', 200);
        }
        else{
            return $this->apiResponse(null, 'Brand Not Deleted', 404);
        }
    }

    public function products()
    {
        $products = $this->brandRepository->products();
        if($products)
        {
            return $this->apiResponse($products, 'Products Found Successfully', 200);
        }
        else{
            return $this->apiResponse(null, 'Products Not Found', 404);
        }
    }
}
