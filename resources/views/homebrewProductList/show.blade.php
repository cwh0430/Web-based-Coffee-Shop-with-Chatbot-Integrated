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
            <input type="hidden" name="homebrewProduct_id" value="{{$homebrewProduct->id}}">
            <input type="hidden" name="modelType" value="HomebrewProduct">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="img-div">
                        <img src="/storage/{{$homebrewProduct->img}}" alt="homebrewProduct"
                            class="product-image img-fluid">

                    </div>
                </div>
                <div class="col-md-7 mt-1">
                    <h2 class="homebrewProduct-title">{{ucwords($homebrewProduct->name)}}</h2>
                    <p class="homebrewProduct-description text-muted">
                        {!! $homebrewProduct->desc !!}
                    </p>
                    <p>RM {{number_format($homebrewProduct->price,2, '.')}}</p>

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
                            <p class="pt-1 rating-avg">{{number_format($averageRating,1,'.')}}</p>
                            <div>
                                @for ($i = 0; $i < $averageRating; $i++) <span class="fa fa-star star-active">
                                    </span>
                                    @endfor

                                    @for ($i = $averageRating; $i < 5; $i++) <span class="fa fa-star star-inactive">
                                        </span>
                                        @endfor
                            </div>
                            <p class="text-muted justify-content-center">{{count($reviews)}} ratings</p>

                            @auth
                            <div style="width: 100%">
                                <button type="button" class=" text-muted btn text-center mx-auto" style="width: 30%;"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Write a review
                                </button>
                            </div>

                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Rate and Review</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <form action="{{route('review.store')}}" method="POST" id="review-form">
                                                @csrf
                                                <p>{{$beverage->name}} Review Form</p>
                                                <div class="mb-3">

                                                    <div class="ratings">
                                                        <input type="hidden" value=0 id="rating" name="rating">
                                                        <input type="hidden" name="modelType" value="Beverage">
                                                        <input type="hidden" name="product_id"
                                                            value="{{$beverage->id}}">
                                                        @for ($i = 1; $i <= 5; $i++) <span class="star"
                                                            data-rating="{{ $i }}">
                                                            <span class="fa fa-star star-inactive mx-1"
                                                                id="star-{{$i}}"></span>
                                                            </span>
                                                            @endfor
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <textarea class="form-control" id="comment" name="comment" rows="4"
                                                        placeholder="Leave out Your Comment" required></textarea>
                                                </div>

                                                <button type="submit" class="btn add-to-cart">Submit</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            @endauth
                        </div>

                        <hr class="my-3">
                        @foreach ($reviews as $review)
                        @foreach ($review->related as $comments)
                        <div class="col-md-11">
                            <div class="row">
                                <div class="col-md-12 text-start mb-3">
                                    <div class="row">
                                        <span class="stars">
                                            @for ($i = 0; $i < $comments->rating; $i++) <span
                                                    class="fa fa-star star-active">
                                                </span>
                                                @endfor

                                                @for ($i = $comments->rating; $i < 5; $i++) <span
                                                    class="fa fa-star star-inactive"></span>
                                        @endfor
                                        </span>
                                        <p class="mb-0 client-name text-muted">{{$review->user->name}}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <p class="content text-start">{{$comments->comment}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endforeach
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

                        <a href="/showhomebrewproduct/{{$rcmd->id}}" class="view-detail">VIEW IN DETAIL
                            <i class="fa-solid fa-expand"></i>
                        </a>

                        <a href="/showhomebrewproduct/{{$rcmd->id}}"
                            class="add-to-cart-responsive d-block d-xl-none">VIEW IN
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