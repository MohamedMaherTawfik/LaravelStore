<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\marketPlaceRequest;
use App\Http\Resources\marketPlaceResource;
use App\Services\marketPlaceService;
use Illuminate\Http\Request;
use App\Models\marketPlace;

class marketPlaceController extends Controller
{
    use apiResponse;
    private $marketPlace;

    public function __construct(marketPlaceService $marketPlace)
    {
        $this->marketPlace = $marketPlace;
    }

    public function index()
    {
        return $this->marketPlace->index();
    }

    public function store(marketPlaceRequest $request)
    {
        return $this->marketPlace->store($request);
    }

    public function show()
    {
        return $this->marketPlace->show();
    }

    public function update(marketPlaceRequest $request)
    {
        return $this->marketPlace->update($request);
    }

    public function destroy()
    {
        return $this->marketPlace->destroy();
    }

    public function products()
    {
        return $this->marketPlace->products();
    }
}
