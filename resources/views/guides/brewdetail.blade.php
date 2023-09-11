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
                                <img src="/storage/{{$brew->img}}" alt="{{$brew->name}}" class="img-fluid">
                            </div>
                            <div class="ing-div">
                                <div class="col-10 mx-auto">
                                    <p class="part-title">Ingredients Needed</p>

                                    <ul class="ing-list">
                                        @foreach ($brew->using_tools as $tool)
                                        <li>{{$tool['tool_name']}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="rcmd-div">
                                <div class="col-10 mx-auto text-center">
                                    <p class="rcmd-title">Explore the perfect tools to get the most enjoyable pour
                                        over</p>
                                    <a href="/mechaniclist" class="btn route-btn"> Our Tools</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="name-div">
                                <div class="col-10 mx-auto">
                                    <p class="name-title text-center">{{$brew->name}}</p>
                                </div>
                            </div>
                            <div class="desc-div">
                                <div class="col-10 mx-auto">
                                    <p class="part-title text-center">Description</p>
                                    <div class="text-center desc-text">
                                        {!! $brew->desc !!}
                                    </div>
                                </div>
                            </div>
                            <div class="steps-div">
                                <div class="col-10 mx-auto">
                                    <p class="part-title">Steps</p>
                                    <ol class="steps-list">
                                        @foreach ($brew->instructions as $steps)
                                        <li>{{$steps['step']}}</li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                            @if (!empty($recipe->tips) && $recipe->tips[0]['tip'] !== null)
                            <div class="steps-div">
                                <div class="col-10 mx-auto">
                                    <p class="part-title">Tips</p>
                                    <ol class="steps-list">
                                        @foreach ($recipe->tips as $tips)
                                        <li>{{$tips['tip']}}</li><br><br>
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