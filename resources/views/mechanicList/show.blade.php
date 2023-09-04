@extends('layouts.app')

@section('content')
<link href="{{ asset('css/show.css') }}" rel="stylesheet">

<div class="container-fluid mt-5">

    {{-- @if (session('msg'))
    <p>{{session('msg')}}</p>
    @endif --}}
    <!-- Sample Beverage Detail Page Content -->
    <div class="col-lg-12 col-xl-12 ">
        <form action="/addproductcart" method="POST">
            @csrf
            <input type="hidden" name="mechanic_id" value="{{$mechanic->id}}">
            <input type="hidden" name="modelType" value="Mechanic">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="img-div">
                        <img src="/storage/{{$mechanic->img}}" alt="mechanic" class="product-image img-fluid">

                    </div>
                </div>
                <div class="col-md-7 mt-1">
                    <h2 class="mechanic-title">{{ucwords($mechanic->name)}}</h2>
                    <p class="mechanic-description text-muted">
                        {!! $mechanic->desc !!}
                    </p>
                    <p>RM {{number_format($mechanic->price,2, '.')}}</p>

                    <div class="mb-3 mt-3">
                        <div class=" col-3">
                            <div class="input-group mb-3" style="width: 150px;">
                                <button class="btn btn-white border px-3" type="button" id="minusBtn"
                                    onclick="minusQuantity()">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" name="quantity" class="form-control text-center border" value="1"
                                    id="quantityInput" min="1" />
                                <button class="btn btn-white border px-3" type="button" onclick="addQuantity()">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <button type="submit" class="add-to-cart btn">ADD TO CART</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Ratings and Reviews -->
        <div class="row ratings-reviews mt-5 justify-content-center">
            <div class="col-9">
                <h3 class="text-center mb-4">Ratings and Reviews</h3>

                <div>
                    <div class="row justify-content-center align-items-center d-flex text-center py-3"
                        style="border: 1px solid black;">
                        <div class="col-md-5 d-flex flex-column">
                            <p class="pt-1 rating-avg">4.0</p>
                            <div>
                                <span class="fa fa-star star-active mx-1"></span>
                                <span class="fa fa-star star-active mx-1"></span>
                                <span class="fa fa-star star-active mx-1"></span>
                                <span class="fa fa-star star-active mx-1"></span>
                                <span class="fa fa-star star-inactive mx-1"></span>
                            </div>
                            <p class="text-muted justify-content-center">123 ratings</p>

                        </div>


                        <div class="col-md-7">
                            <div class="rating-bar0 justify-content-center">
                                <table class="text-left mx-auto">
                                    <tr>
                                        <td class="rating-label">5</td>
                                        <td class="rating-bar">
                                            <div class="bar-container">
                                                <div class="bar-5"></div>
                                            </div>
                                        </td>
                                        <td class="text-right">123</td>
                                    </tr>
                                    <tr>
                                        <td class="rating-label">4</td>
                                        <td class="rating-bar">
                                            <div class="bar-container">
                                                <div class="bar-4"></div>
                                            </div>
                                        </td>
                                        <td class="text-right">23</td>
                                    </tr>
                                    <tr>
                                        <td class="rating-label">3</td>
                                        <td class="rating-bar">
                                            <div class="bar-container">
                                                <div class="bar-3"></div>
                                            </div>
                                        </td>
                                        <td class="text-right">10</td>
                                    </tr>
                                    <tr>
                                        <td class="rating-label">2</td>
                                        <td class="rating-bar">
                                            <div class="bar-container">
                                                <div class="bar-2"></div>
                                            </div>
                                        </td>
                                        <td class="text-right">3</td>
                                    </tr>
                                    <tr>
                                        <td class="rating-label">1</td>
                                        <td class="rating-bar">
                                            <div class="bar-container">
                                                <div class="bar-1"></div>
                                            </div>
                                        </td>
                                        <td class="text-right">0</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <hr class="my-3">
                        <div class="col-md-11">
                            <div class="row">
                                <div class="col-md-12 text-start mb-3">
                                    <div class="row">
                                        <span class="stars">
                                            <span class="fa fa-star star-active"></span>
                                            <span class="fa fa-star star-active"></span>
                                            <span class="fa fa-star star-active"></span>
                                            <span class="fa fa-star star-active"></span>
                                            <span class="fa fa-star star-inactive"></span>
                                        </span>
                                        <p class="mb-0 client-name text-muted">Vikram jit Singh </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <p class="content text-start">If you really enjoy coffee or would like to try
                                        something
                                        new and
                                        exciting for the first time.</p>
                                </div>
                            </div>
                        </div>
                        <hr class="my-3">

                        <div class="col-md-11">
                            <div class="row">
                                <div class="col-md-12 text-start mb-3">
                                    <div class="row">
                                        <span class="stars">
                                            <span class="fa fa-star star-active"></span>
                                            <span class="fa fa-star star-active"></span>
                                            <span class="fa fa-star star-active"></span>
                                            <span class="fa fa-star star-active"></span>
                                            <span class="fa fa-star star-inactive"></span>
                                        </span>
                                        <p class="mb-0 client-name text-muted">Vikram jit Singh </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <p class="content text-start">If you really enjoy coffee or would like to try
                                        something
                                        new and
                                        exciting for the first time.</p>
                                </div>
                            </div>
                        </div>
                        <hr class="my-3">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Similar Product Recommendations -->
    <div class="row similar-products justify-content-center mb-5 mt-5">
        <div class="col-11">
            <p class="text-muted rcmd text-center">You May Also Like</p>

        </div>
        <div class="col-md-8">
            <div class="row mr-lg-4 mr-md-4 mb-sm-5 mb-xl-0 mb-lg-0 mb-md-0 mb-5 row-small-width">
                @foreach ($recommendations as $item)
                <div class="col-xl-4 col-md-6 col-sm-8 col-8 borders-line">
                    <div class="img-rcmd-div">
                        <img src="/storage/{{$rcmd->img}}" alt="product" class="img-fluid" />
                    </div>

                    <p class="product-name">{{$rcmd->name}}</p>
                    <div class="price-container">
                        <p class="price">RM {{number_format($rcmd->price,2, '.')}}</p>

                        <a href="/showmechanic/{{$rcmd->id}}" class="view-detail">VIEW IN DETAIL
                            <i class="fa-solid fa-expand"></i>
                        </a>

                        <a href="/showmechanic/{{$rcmd->id}}" class="add-to-cart-responsive d-block d-xl-none">VIEW IN
                            DETAIL
                            <i class="fa-solid fa-expand"></i>
                        </a>

                    </div>

                </div>
                @endforeach


            </div>
        </div>
    </div>

    @include('chatbot.chatbot')
</div>



<script src="/js/show.js"></script>


@endsection