<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\cartRequest;
use App\Services\CartItemsServices;

class cartController extends Controller
{
    use apiResponse;
    private $cartitemsServices;

    public function __construct(CartItemsServices $cartitemsServices)
    {
        $this->cartitemsServices = $cartitemsServices;
    }

    public function add_to_cart()
    {
        return $this->cartitemsServices->add_to_cart();
    }

    public function get_cart()
    {
        return $this->cartitemsServices->get_cart_items();
    }

    public function remove_from_cart()
    {
        return $this->cartitemsServices->remove_from_cart();
    }

    public function clear_cart()
    {
        return $this->cartitemsServices->clear_cart();
    }

}
