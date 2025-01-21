<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\productRequest;
use App\Http\Resources\productResource;
use App\Http\Resources\productsResource;
use App\Models\cartitems;
use App\Models\products;
use App\Services\productsServices;
use Auth;
use Illuminate\Http\Request;

class productsController extends Controller
{
    use apiResponse;
    private $productsServices;
    public function __construct(productsServices $productsServices)
    {
        $this->productsServices = $productsServices;
    }

    public function index()
    {
        return $this->productsServices->index();
    }

    public function show()
    {
        return $this->productsServices->show();
    }

    public function store(productRequest $request)
    {
        return $this->productsServices->store($request);
    }

    public function update(productRequest $request)
    {
        return $this->productsServices->update($request);
    }

    public function destroy()
    {
        return $this->productsServices->destroy();
    }
}
