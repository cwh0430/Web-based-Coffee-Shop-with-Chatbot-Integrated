@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js"></script>
    <link href="{{ asset('css/productlist.css') }}" rel="stylesheet">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/9.0.0/nouislider.min.css' rel="stylesheet">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/9.0.0/nouislider.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/wnumb/1.0.4/wNumb.min.js'></script>



</head>

<body>

    <div class="container-fluid mt-5 mb-5">

        @if (session('msg'))
        <p>{{session('msg')}}</p>
        @endif
        <div class="row">
            <div class="col-xl-8 col-md-8 col-sm-12 col-12">
                <!-- Display items in tables/boxes -->
                @if (sizeof($beverages) > 0)
                <div class="row me-lg-4 me-md-4 mb-sm-5 mb-xl-0 mb-lg-0 mb-md-0 mb-5 row-small-width">
                    @foreach ($beverages as $beverage)
                    <div class="col-xl-4 col-md-6 col-sm-8 col-8 borders-line">
                        <div class="img-div">
                            <img src="storage/{{$beverage->img}}" alt="product" class="img-fluid" />
                        </div>

                        <p class="product-name">{{$beverage->name}}</p>
                        <div class="price-container">
                            <p class="price"> RM {{number_format($beverage->price,2, '.')}}</p>


                            <input type="hidden" name="beverage_id" value="{{$beverage->id}}">
                            <input type="hidden" name="quantity" value=1>
                            <input type="hidden" name="modelType" value="Beverage">
                            <a href="/showbeverage/{{$beverage->id}}" class="view-in-detail">VIEW IN DETAIL
                                <i class="fa-solid fa-expand"></i>
                            </a>

                            <a href="/showbeverage/{{$beverage->id}}"
                                class="view-in-detail-responsive d-block d-xl-none">VIEW IN
                                DETAIL
                                <i class="fa-solid fa-expand"></i>
                            </a>

                        </div>

                    </div>
                    @endforeach
                </div>
                @else
                <div class="col-12 mt-5">
                    <p class="text-center text-muted justify-content-center empty-item">No available item found</p>
                </div>
                @endif

            </div>
            <div class="col-xl-3 col-md-3 col-sm-8 col-8">
                <!-- Filter/Search column -->
                {{-- <input type="range" class="form-range" min="0" max="100" value="0" id="customRange">
                <span id="sliderValue">0</span> --}}
                <div>
                    <h3>Filter By Price</h3>
                    <form method="GET" action="{{route('beveragelist')}}">
                        @csrf
                        <div id="test5" class="noUiSlider"></div>

                        <input type="hidden" name="min_price" id="min-price-input">
                        <input type="hidden" name="max_price" id="max-price-input">
                        <span class="d-none" id="range-max-price">{{$rangeMaxPrice}}</span>
                        @if (request('category') && request('category') !== '')
                        <input type="hidden" name="category" value={{request('category')}}>
                        @endif
                        @if (request('search') && request('search') !== '')
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

                        <div class="row" style="margin-top: 10px;">
                            <div class="col d-flex justify-content-start minprice">
                                <span id="min-price">RM{{number_format($minPrice,2,'.')}}</span>
                            </div>
                            <div class="col d-flex justify-content-end maxprice">
                                <span id="max-price">RM{{number_format($maxPrice,2,'.')}}</span>
                            </div>
                        </div>

                        <div class="row justify-content-end mt-3">
                            <button class="reset-btn hidden" id="resetButton">Reset</button>
                            <button type="submit" class="apply-btn">Apply</button>
                        </div>


                    </form>
                </div>


                <form method="GET" action="{{route('beveragelist')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="search-input" class="form-label">Search:</label>
                        <input type="text" class="form-control" id="search-input" name="search" required>
                    </div>

                    @if (request('min_price') && request('max_price') && request('max_price') !== '' &&
                    request('min_price') !== '')
                    <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                    <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                    @endif

                    @if (request('category') && request('category') !== '')
                    <input type="hidden" name="category" value={{request('category')}}>
                    @endif


                    <div class="text-end">
                        <button class="filter-btn" type="submit"><span class="filter-btn-text">Apply
                                Filter</span></button>
                    </div>

                </form>

                <form method="GET" action="{{route('beveragelist')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="filter-select" class="form-label">Category Filter:</label>
                        <select class="form-select" id="filter-select" name="category">
                            <option value="">No Filter</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}" @if (request('category')==$category->id) selected
                                @endif>{{ucwords($category->name)}}</option>
                            @endforeach
                        </select>


                        @if (request('min_price') && request('max_price') && request('max_price') !== '' &&
                        request('min_price') !== '')
                        <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                        <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                        @endif

                        @if (request('search') && request('search') !== '')
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

                    </div>
                    @if (request('category') !== '')
                    <div class="text-end">
                        <button class="filter-btn" type="submit"><span class="filter-btn-text">Apply
                                Filter</span></button>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
    @include('chatbot.chatbot')
</body>
<script src="{{ asset('js/beveragelist.js') }}"></script>

</html>
@endsection