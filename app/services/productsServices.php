<?php

namespace App\Services;

use App\Http\Controllers\api\apiResponse;
use App\Http\Requests\productRequest;
use App\Models\products;
use App\Repository\productsRepository;

class productsServices
{

    use apiResponse;

    private $productsRepository;

    public function __construct(productsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }
    public function index()
    {

        $products = $this->productsRepository->all();
        if($products)
        {
            return $this->apiResponse($products, 'Products Found Successfully', 200);
        }
        else{
            return $this->apiResponse(null, 'Products Not Found', 404);
        }
    }

    public function show()
    {
        $product = $this->productsRepository->find();
        if($product)
        {
            return $this->apiResponse($product, 'Product Found Successfully', 200);
        }
        else{
            return $this->apiResponse(null, 'Product Not Found', 404);
        }
    }

    public function store(productRequest $request)
    {
        $fields=$request->validated();
        if($request->hasFile('image'))
        {
            $image=$request->file('image');
            $image->move(public_path('uploads'), $image->getClientOriginalName());
            $fields['image'] = $image->getClientOriginalName();
        }
        $product= $this->productsRepository->create($fields);
        return $this->apiResponse($product, 'Product Created Successfully', 201);
    }

    public function update(productRequest $request)
    {
        $fields=$request->validated();
        $product=$this->productsRepository->find();
        if(!$product)
        {
            return $this->apiResponse(null, 'Product Not Found', 404);
        }

        if($request->hasFile('image'))
        {
            $image=$request->file('image');
            $image->move(public_path('uploads'), $image->getClientOriginalName());
            $fields['image'] = $image->getClientOriginalName();
        }
        if($product)
        {
            $this->productsRepository->update($fields);
            return $this->apiResponse($product, 'Product Updated Successfully', 200);
        }
        else{
            return $this->apiResponse(null, 'Product Not Found', 404);
        }
    }

    public function destroy()
    {
        $product=$this->productsRepository->find();
        if($product)
        {
            $product->delete();
            return $this->apiResponse(null, 'Product Deleted Successfully', 200);
        }
        else{
            return $this->apiResponse(null, 'Product Not Found', 404);
        }
    }
}
