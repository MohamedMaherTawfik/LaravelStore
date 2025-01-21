<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\orderRequest;
use App\Models\order_items;
use App\Models\orders;
use App\Models\products;
use App\Models\User;
use App\Services\orderServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ordersController extends Controller
{
    use apiResponse;
    private $orderServices;

    public function __construct(orderServices $orderServices){
        $this->orderServices = $orderServices;
    }


    public function index(){
        return $this->orderServices->index();
    }


    public function show(){
        return $this->orderServices->show();
    }


    public function store(orderRequest $request){
        return $this->orderServices->store($request);
    }


    public function get_order_items(){
        return $this->orderServices->get_order_items();
    }


    public function destroy(){
        return $this->orderServices->destroy();
    }


    public function change_status(){
        return $this->orderServices->change_status();
    }


    public function get_user_orders(){
        return $this->orderServices->get_user_orders();
    }

}
