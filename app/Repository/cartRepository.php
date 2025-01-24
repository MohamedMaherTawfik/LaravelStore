<?php

namespace App\Repository;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class cartRepository
{
    private $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function get_cart_items()
    {
        return $this->cart->with('products')->where('user_id', Auth::user()->id)->get();
    }

    public function find_user_cart()
    {
        return $this->cart->where('user_id', Auth::user()->id)->first();
    }

}
