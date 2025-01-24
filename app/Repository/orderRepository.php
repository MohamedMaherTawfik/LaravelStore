<?php

namespace App\Repository;

use App\Models\orders;
use App\Models\User;

class orderRepository
{
    private $orders;

    public function __construct(orders $orders)
    {
        $this->orders = $orders;
    }

    public function all()
    {
        return $this->orders::all();
    }

    public function find()
    {
        return $this->orders::with('order_items')->find(request('id'));
    }

    public function destroy()
    {
        return $this->orders::where('id', request('id'))->delete();
    }

    public function get_user_orders()
    {
        return User::with('orders', 'orders.order_items')->find(request('id'));
    }
}
