@extends('layouts.app')
@section('content')
@if (Auth::check())
@include('beverageCart.authenticatedBeverageIndex')
@else
@include('beverageCart.guestBeverageIndex')

@endif

@endsection