@extends('layouts.app')

@section('content')
<link href="{{ asset('css/guide.css') }}" rel="stylesheet">

<div class="container">
    <ul class="nav nav-tabs justify-content-center mt-4" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="recipe-tab" data-bs-toggle="tab" data-bs-target="#recipe" type="button"
                role="tab" aria-controls="recipe" aria-selected="true">Recipe</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="brew-tab" data-bs-toggle="tab" data-bs-target="#brew" type="button" role="tab"
                aria-controls="brew" aria-selected="false">Brewing</button>
        </li>

    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="recipe" role="tabpanel" aria-labelledby="recipe-tab">
            @include('guides.recipe', ['recipes' => $recipes])</div>
        <div class="tab-pane fade" id="brew" role="tabpanel" aria-labelledby="brew-tab">@include('guides.brew', ['brews'
            => $brews])</div>
    </div>
</div>

@endsection