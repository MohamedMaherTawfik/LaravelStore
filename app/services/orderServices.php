<?php

namespace App\Services;

use App\Http\Controllers\api\apiResponse;
use App\Http\Requests\orderRequest;
use App\Models\Cart;
use App\Models\order_items;
use App\Models\orders;
use App\Models\products;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Repository\orderRepository;

class orderServices
{
    use apiResponse;

    private $ordersRepository;

    public function __construct(orderRepository $ordersRepository)
    {
        $this->ordersRepository = $ordersRepository;
    }
    public function index()
    {
        $orders = $this->ordersRepository->all();
        if($orders)
        {
        return $this->apiResponse($orders, 'orders Found Successfully', 200);
        }
        else
        {
            return $this->apiResponse(null, 'orders Not Found', 404);
        }
    }

    public function show()
    {
        $order = $this->ordersRepository->find();
        if($order)
        {
            return $this->apiResponse($order, 'order Found Successfully', 200);
        }
        else{
            return $this->apiResponse(null, 'order Not Found', 404);
        }
    }

    public function store(orderRequest $request)
    {
        try {
            $request->validated();
        $order = orders::create([
            'user_id' => Auth::user()->id,
            'location' => request('location'),
            'total' => request('total'),
            'details' => request('details'),
        ]);

        $order_items=Cart::with('products')->where('user_id', Auth::user()->id)->get();
        foreach($order_items as $order_item)
        {
            foreach($order_item->products as $product)
            {
                order_items::create([
                    'orders_id' => $order->id,
                    'products_id' => $product->id,
                    'quantity' => $order_item->quantity,
                    'price' => $product->price,
                ]);
            }
        }
        $order->load('order_items');
        return $this->apiResponse($order, 'order Created Successfully', 200);
        } catch (Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), 500);
        }

    }


    public function get_order_items()
    {
        $order_items=order_items::where('orders_id', request('id'))->get();

        if($order_items)
        {
            foreach($order_items as $order_item)
            {
                $product = products::where('id', $order_item->products_id)->pluck('name');
                $order_item->product_name = $product['0'];
            }

            return $this->apiResponse($order_items, 'order_items Found Successfully', 200);
        }
        else{
            return $this->apiResponse(null, 'order_items Not Found', 404);
        }
    }

    public function destroy()
    {
        $order=orders::find(request('id'));
        if($order)
        {
            $order->delete();
            return $this->apiResponse(null, 'order Deleted Successfully', 200);
        }
        else{
            return $this->apiResponse(null, 'order Not Found', 404);
        }
    }

    public function change_status()
    {
        $order = $this->ordersRepository->find();
        if($order)
        {
            $order->update([
                'status' => request('status'),
            ]);
            return $this->apiResponse($order, 'order status changed Successfully', 200);
        }
        else{
            return $this->apiResponse(null, 'order Not Found', 404);
        }
    }

    public function get_user_orders()
    {
        $user=$this->ordersRepository->get_user_orders();
        if($user){
            return $this->apiResponse($user, 'user orders Found Successfully', 200);
        }
        else{
            return $this->apiResponse(null, 'user orders Not Found', 404);
        }
    }

}
