<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\brandRequest;
use App\Http\Resources\brandResource;
use App\Services\brandServices;

class brandController extends Controller
{
    use apiResponse;
    private $brandServices;
    public function __construct(brandServices $brandServices)
    {
        $this->brandServices = $brandServices;
    }

    public function index()
    {
        return $this->brandServices->index();
    }


    public function store(brandRequest $request)
    {
        return $this->brandServices->store($request);
    }


    public function show()
    {
        return $this->brandServices->show();
    }


    public function update(brandRequest $request)
    {
        return $this->brandServices->update($request);
    }


    public function destroy()
    {
        return $this->brandServices->destroy();
    }


    public function products()
    {
        return $this->brandServices->products();
    }

}
