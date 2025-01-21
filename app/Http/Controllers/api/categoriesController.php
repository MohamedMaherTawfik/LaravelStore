<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\categoreyRequest;
use App\Http\Resources\categoreyResource;
use App\Models\categories;
use App\Services\categoreyServices;
use Illuminate\Http\Request;


class categoriesController extends Controller
{
    use apiResponse;
    private $categoreyServices;
    public function __construct(categoreyServices $categoreyServices)
    {
        $this->categoreyServices =$categoreyServices;
    }

    public function index()
    {
        return $this->categoreyServices->index();
    }

    public function store(categoreyRequest $request)
    {
        return $this->categoreyServices->store($request);
    }

    public function show(categories $categories)
    {
        return $this->categoreyServices->show();
    }

    public function update(categoreyRequest $request)
    {
        return $this->categoreyServices->update($request);
    }

    public function destroy()
    {
        return $this->categoreyServices->destroy();
    }


    public function products()
    {
        return $this->categoreyServices->products();
    }

}
