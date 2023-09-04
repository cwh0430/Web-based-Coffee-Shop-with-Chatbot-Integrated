<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Confirmation</title>
</head>

<body>
    <p>Hi {{ucwords($name)}}</p>
    <p>Your Order has been successfully placed</p>
    <table style="width: 600px; text-align:right;">
        <thead>
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->related as $item)
            <tr>
                <td>{{ucwords($item->itemable->name)}}</td>
                <td>{{$item->quantity}}</td>
                <td>RM{{$item->sub_price}}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="2" style="border-top: 1px solid #ccc;"></td>
                <td style="font-size:15px; font-weight:bold; border-top: 1px solid #ccc;">Total: RM
                    {{$order->total_price}}</td>
            </tr>

            <tr></tr>
        </tbody>
    </table>
</body>

</html>