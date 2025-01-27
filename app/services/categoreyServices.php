<?php

namespace App\Services;

use App\Http\Controllers\api\apiResponse;
use App\Http\Requests\categoreyRequest;
use App\Http\Resources\categoreyResource;
use App\Models\categories;
use App\Repository\categoreyRepository;

class categoreyServices
{
    use apiResponse;
    private $categoreyRepository;
    public function __construct(categoreyRepository $categoreyRepository)
    {
        $this->categoreyRepository = $categoreyRepository;
    }
    public function index()
    {
        $categories = $this->categoreyRepository->all();
        return $this->apiResponse($categories, 'All Categoreys', 200);
    }

    public function store(categoreyRequest $request)
    {
        $fields=$request->validated();
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('categories'), $filename);
            $fields['image'] = $filename;
        }

        $categorey=$this->categoreyRepository->create($fields);
        return $this->apiResponse($categorey, 'Categorey Created Successfully', 201);
    }

    public function show()
    {
        $categories= $this->categoreyRepository->find();
        if($categories)
        {
            return $this->apiResponse(new categoreyResource($categories), 'Categorey Found Successfully', 200);
        }
        else{
            return $this->apiResponse(null, 'Categorey Not Found', 404);
        }
    }

    public function update(categoreyRequest $request)
    {
        $fields=$request->validated();
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('categories'), $filename);
            $fields['image'] = $filename;
        }

        $categorey=$this->categoreyRepository->create($fields);

        if($categorey)
        {
            return $this->apiResponse($categorey, 'Categorey Updated Successfully', 200);
        }
        else{
            return $this->apiResponse(null, 'Categorey Not Updated', 404);
        }
    }

    public function destroy()
    {
        $categories=$this->categoreyRepository->find();
        if($categories)
        {
            return $this->apiResponse(null, 'Categorey Deleted Successfully', 200);
        }
        else{
            return $this->apiResponse(null, 'Categorey Not Deleted', 404);
        }
    }

    public function products()
    {
        $products = $this->categoreyRepository->products();
        if($products)
        {
            return $this->apiResponse($products, 'categorey Found Successfully', 200);
        }
        else{
            return $this->apiResponse(null, 'categorey Not Found', 404);
        }
    }
}
