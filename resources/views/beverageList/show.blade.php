@extends('layouts.app')

@section('content')
<link href="{{ asset('css/show.css') }}" rel="stylesheet">

<div class="container-fluid mt-5">

    {{-- @if (session('msg'))
    <p>{{session('msg')}}</p>
    @endif --}}
    <!-- Sample Beverage Detail Page Content -->
    <div class="col-lg-12 col-xl-12 ">
        <form action="/addbeveragecart" method="POST">
            @csrf
            <input type="hidden" name="beverage_id" value="{{$beverage->id}}">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="img-div">
                        <img src="/storage/{{$beverage->img}}" alt="Beverage" class="product-image img-fluid">

                    </div>
                </div>
                <div class="col-md-7 mt-1">
                    <h2 class="beverage-title">{{ucwords($beverage->name)}}</h2>
                    <p class="beverage-description text-muted">
                        {!! $beverage->desc !!}
                    </p>
                    <p>RM {{number_format($beverage->price,2, '.')}}</p>

                    <div class="form-floating mb-3 size-select">
                        <select name="size" id="floatingSelectSize" class="form-select" required>
                            <option value="">Select a Size</option>
                            <option value="Medium">Medium(+RM0.00)</option>
                            <option value="Tall">Tall(+RM2.00)</option>
                        </select>
                        <label for="floatingSelectSize">Size Option</label>
                    </div>


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




                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Extra Customization
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="form-floating mb-3">
                                        <select name="milkType" id="floatingSelectMilkType" class="form-select">
                                            <option value="">Select a Milk Type</option>
                                            <option value="wholeMilk">Whole Milk (+RM0.00)</option>
                                            <option value="AlmondMilk">Almond Milk (+RM2.00)</option>
                                            <option value="soyMilk">Soy Milk (+RM2.00)</option>
                                            <option value="oatMilk">Oat Milk (+RM2.00)</option>
                                        </select>
                                        <label for="floatingSelectMilkType">Milk Type Customization</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <select name="sweetenerType" id="floatingSelectSweetenerType"
                                            class="form-select">
                                            <option value="">Select a Sweetener Type</option>
                                            <option value="Sugar">Sugar (+RM0.00)</option>
                                            <option value="Honey">Honey (+RM1.00)</option>
                                            <option value="Stevia">Stevia (+RM1.00)</option>
                                            <option value="mapleSyrup">Maple Syrup (+RM1.00)</option>
                                        </select>
                                        <label for="floatingSelectSweetenerType">Sweetener Type Customization</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <select name="flavorShot" id="floatingSelectFlavorShot" class="form-select">
                                            <option value="">Select a Flavor Shot</option>
                                            <option value="Vanilla">Vanilla (+RM2.00)</option>
                                            <option value="Caramel">Caramel (+RM2.00)</option>
                                            <option value="Hazelnut">Hazelnut (+RM2.00)</option>
                                        </select>
                                        <label for="floatingSelectFlavorShot">Flavor Shot Customization</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <select name="espressoShot" id="floatingSelectEspressoShot" class="form-select">
                                            <option value="">Select a Espresso Shot</option>
                                            <option value="1">1 (+RM0.00)</option>
                                            <option value="2">2 (+RM1.00)</option>
                                            <option value="3">3 (+RM2.00)</option>
                                        </select>
                                        <label for="floatingSelectEspressoShot">Expresso Shot Customization</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <select name="roastLevel" id="floatingSelectRoastLevel" class="form-select">
                                            <option value="">Select a Roast Level</option>
                                            <option value="Low">Low</option>
                                            <option value="Medium">Medium</option>
                                            <option value="High">High</option>
                                        </select>
                                        <label for="floatingSelectRoastLevel">Roast Level Customization</label>
                                    </div>



                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Nutritional Information
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Calories: around 250-300 kcal<br>
                                    Total Fat: 9-12 grams<br>
                                    Saturated Fat: 6-8 grams<br>
                                    Cholesterol: 25-35 mg<br>
                                    Sodium: 130-150 mg<br>
                                    Total Carbohydrates: 32-40 grams<br>
                                    Dietary Fiber: 0 grams<br>
                                    Sugars: 30-35 grams<br>
                                    Protein: 8-10 grams<br>
                                </div>
                            </div>
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
                @foreach ($recommendations as $rcmd)
                <div class="col-xl-4 col-md-6 col-sm-8 col-8 borders-line">
                    <div class="img-rcmd-div">
                        <img src="/storage/{{$rcmd->img}}" alt="product" class="img-fluid" />
                    </div>

                    <p class="product-name">{{$rcmd->name}}</p>
                    <div class="price-container">
                        <p class="price">RM {{number_format($rcmd->price,2, '.')}}</p>

                        <a href="/showbeverage/{{$rcmd->id}}" class="view-detail">VIEW IN DETAIL
                            <i class="fa-solid fa-expand"></i>
                        </a>

                        <a href="/showbeverage/{{$rcmd->id}}" class="add-to-cart-responsive d-block d-xl-none">VIEW IN
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