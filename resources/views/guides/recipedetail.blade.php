@extends('layouts.app')

@section('content')
<link href="{{ asset('css/guidedetail.css') }}" rel="stylesheet">

<div class="container-fluid py-5 mb-2 recipe-detail">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-xl-10">
            <div class="card rounded-3 text-black">
                <div class="card-body" style="height: 100%;">
                    <div class="row g-0" style="height: 100%">
                        <div class="col-5" style="display: flex; flex-direction: column;">
                            <div class="img-box">
                                <img src="/storage/{{$recipe->img}}" alt="" class="img-fluid">
                            </div>
                            <div class="ing-div">
                                <div class="col-10 mx-auto">
                                    <p class="part-title">Ingredients Needed</p>

                                    <ul class="ing-list">
                                        @foreach ($recipe->ingredients as $ingredient)
                                        <li>{{$ingredient['ingredientInfo']['quantity']}}
                                            {{$ingredient['ingredientInfo']['unit']}} of
                                            {{$ingredient['ingredientInfo']['item']}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="rcmd-div">
                                <div class="col-10 mx-auto text-center">
                                    <p class="rcmd-title">Explore the perfect beverage to get the most enjoyable pour
                                        over</p>
                                    <a href="/beveragelist" class="btn route-btn"> Our Beverage</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="name-div">
                                <div class="col-10 mx-auto">
                                    <p class="name-title text-center">{{$recipe->name}}</p>
                                </div>
                            </div>
                            <div class="desc-div">
                                <div class="col-10 mx-auto">
                                    <p class="part-title text-center">Description</p>
                                    <div class="text-center desc-text">
                                        {!! $recipe->desc !!}
                                    </div>
                                </div>
                            </div>
                            <div class="steps-div">
                                <div class="col-10 mx-auto">
                                    <p class="part-title">Steps</p>
                                    <ol class="steps-list">
                                        @foreach ($recipe->instructions as $steps)
                                        <li>{{$steps['step']}}</li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                            @if (!empty($recipe->tips) && $recipe->tips[0]['recipe_tip'] !== null)
                            <div class="steps-div">
                                <div class="col-10 mx-auto">
                                    <p class="part-title">Tips</p>
                                    <ol class="steps-list">
                                        @foreach ($recipe->tips as $tips)
                                        <li>{{$tips['recipe_tip']}}</li>
                                        @endforeach

                                    </ol>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection