<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/cart.js') }}"></script>
    <link rel="stylesheet" href="/css/cart.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body class="bg-white">

    @if (count($productable))
    <div class="container-fluid px-4 cart-container">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12">
                <div class="col-lg-12">
                    <h2 class="h2">Shopping Cart</h2>
                </div>

                <hr>
                <div class="mb-4">
                    @foreach ($productable as $item)
                    <div class="p-2 col-12">
                        <div
                            class="row d-xl-flex d-lg-flex d-md-flex  align-items-center justify-content-center d-none d-sm-none d-md-block d-lg-block d-xl-block">
                            <div class="col-xl-2 col-lg-2 col-md-2">
                                <img src="/storage/{{$item->productable->img}}"
                                    style="width: 60%; height:60%; object-fit:cover;" alt="Generic placeholder image"
                                    class="img-fluid">
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-2 d-flex justify-content-start">
                                <div>
                                    <p class="small text-muted mb-4 pb-2 product-name">Name
                                    </p>
                                    <p class="lead fw-normal mb-0">{{ucwords($item->productable->name)}}</p>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-2 d-flex justify-content-start"
                                style="min-width: 143px;">
                                <div>
                                    <p class="small text-muted mb-4 pb-2 quantity-label">
                                        Quantity</p>
                                    <div class="pl-md-0">
                                        <span><button onclick="userMinusQuantity('{{$item->id}}')" class="btn"
                                                id="minus-btn-{{$item->id}}"><i
                                                    class="fa-solid fa-minus"></i></button></span>
                                        <input type="number" min="1" value="{{$item->quantity}}"
                                            id="quantity-input-{{$item->id}}" disabled />
                                        <span><button onclick="userAddQuantity('{{$item->id}}')" class="btn"
                                                id="plus-btn-{{$item->id}}"><i
                                                    class="fa-solid fa-plus"></i></button></span>
                                    </div>
                                </div>
                            </div>


                            <div class="col-xl-2 col-lg-2 col-md-2 d-flex justify-content-start">
                                <div>
                                    <p class="small text-muted mb-4 pb-2">Price</p>
                                    <p class="lead fw-normal mb-0"> RM {{number_format($item->productable->price,2,
                                        '.')}}</p>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-2 d-flex justify-content-start">
                                <div>
                                    <p class="small text-muted mb-4 pb-2">Total</p>
                                    <p class="lead fw-normal mb-0" id="total-price-{{$item->id}}">RM
                                        {{number_format($itemSubTotal[$item->id],2,
                                        '.')}}</p>
                                </div>
                            </div>
                            <div class="col-xl-1 col-lg-1 col-md-1 d-flex justify-content-start">
                                <div>
                                    <form action="/deleteproductcart/{{$item->id}}" method="POST">
                                        @csrf
                                        <div class="close">
                                            <button type="submit" class="btn"><i class="fa-solid fa-xmark"></i></button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                        <div
                            class="d-flex d-sm-flex align-items-center d-block d-sm-block d-xl-none d-md-none d-lg-none">
                            <div class="col-4 col-sm-3">
                                <img src="/storage/{{$item->productable->img}}"
                                    style="width: 100%; height:100%; object-fit:cover;" alt="Generic placeholder image"
                                    class="img-fluid">
                            </div>
                            <div class="row d-flex d-sm-flex flex-column flex-sm-column col-8">
                                <div class="col-12 col-sm-12 d-flex d-sm-flwx justify-content-start ms-2">
                                    <div>
                                        <p class="lead fw-normal mb-0">{{ucwords($item->productable->name)}}</p>
                                    </div>
                                </div>

                                <div class=" col-12 col-sm-12 d-flex d-sm-flex justify-content-start mt-2 ms-2">
                                    <div>
                                        <p class="lead fw-normal mb-0"> RM {{number_format($item->productable->price,2,
                                            '.')}}</p>
                                    </div>
                                </div>
                                <div class="d-flex d-sm-flex">

                                    <div class="col-8 col-sm-4 d-flex d-sm-flex justify-content-start mt-2">
                                        <div>
                                            <div class="pl-md-0">
                                                <span><button onclick="minusQuantity('{{$item->id}}')" class="btn"
                                                        id="minus-btn-{{$item->id}}-responsive"><i
                                                            class="fa-solid fa-minus"></i></button></span>
                                                <input type="number" min="1" value="{{$item->quantity}}"
                                                    id="quantity-input-{{$item->id}}-responsive" />
                                                <span><button onclick="addQuantity('{{$item->id}}')" class="btn"
                                                        id="plus-btn-{{$item->id}}-responsive"><i
                                                            class="fa-solid fa-plus"></i></button></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class=" col-4 col-sm-4 d-flex d-sm-flex justify-content-start mt-2">
                                        <div>
                                            <form action="/deleteproductcart/{{$item->id}}" method="POST">
                                                @csrf
                                                <div class="close">
                                                    <button type="submit" class="btn"><span
                                                            class="text-muted text-decoration-underline">Remove</span></button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <hr>

                    @endforeach

                </div>

            </div>
        </div>

        {{-- <div>
            <div class="float-end">
                <input type="text" name="discount" placeholder="Coupon Code" class="coupon">
                <button class="coupon-btn" type="submit"><span class="coupon-btn-text">Apply
                        Coupon</span></button>
            </div>
        </div> --}}
    </div>



    <div class=" bg-light rounded-bottom py-4 fixed-bottom">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-10 col-10">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a class="btn btn-md bg-light border border-dark" href="/">Continue Shopping</a>
                    </div>
                    <div class="px-md-0 px-1 footer-font text-center">
                        <b class="pl-md-4">SUBTOTAL <span class="pl-md-4"
                                id="subtotal">RM{{number_format($orderSubTotal,2,
                                '.')}}</span></b>
                    </div>
                    <div>
                        <form action="{{route('checkout')}}" method="POST">
                            @csrf
                            <input type="hidden" name="modelType" value="product">
                            <button class="btn btn-md bg-dark text-white px-lg-4 px-3" type="submit">Proceed to
                                Checkout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <h1>Your Product Cart is Empty</h1>
    </div>
    @endif
</body>



</html>