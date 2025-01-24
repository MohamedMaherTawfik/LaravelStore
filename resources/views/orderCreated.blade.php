<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Thank You for Your Order!</h1>
    <p>Order ID: {{ $order['id'] }}</p>
    <p>Total Amount: ${{ number_format($order['total'], 2) }}</p>
    <p>Items:</p>
    <ul>
        @foreach ($order['order_items'] as $item)
            <li>{{ $item['name'] }} (x{{ $item['quantity'] }}) - ${{ number_format($item['price'], 2) }}</li>
        @endforeach
    </ul>
    <p>We appreciate your business!</p>
</body>
</html>

