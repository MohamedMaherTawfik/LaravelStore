<?php

namespace App\Services;

use App\Http\Controllers\api\apiResponse;
use App\Http\Requests\productRequest;
use App\Models\products;

class productsServices
{

    use apiResponse;

    public function index()
    {

        $products = products::paginate(10);
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
        $product = products::find(request('id'));
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
        $product=products::create($fields);
        return $this->apiResponse($product, 'Product Created Successfully', 201);
    }

    public function update(productRequest $request)
    {
        $fields=$request->validated();
        $product=products::find(request('id'));

        if($request->hasFile('image'))
        {
            $image=$request->file('image');
            $image->move(public_path('uploads'), $image->getClientOriginalName());
            $fields['image'] = $image->getClientOriginalName();
        }
        if($product)
        {
            $product->update($fields);
            return $this->apiResponse($product, 'Product Updated Successfully', 200);
        }
        else{
            return $this->apiResponse(null, 'Product Not Found', 404);
        }
    }

    public function destroy()
    {
        $product=products::find(request('id'));
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
