@extends('layouts.app')
@section('content')
@if (Auth::check())
@include('productCart.authenticatedProductIndex')
@else
@include('productCart.guestProductIndex')

@endif

@endsection