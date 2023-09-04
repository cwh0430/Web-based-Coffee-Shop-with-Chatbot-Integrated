@extends('layouts.app')

@section('content')
<div class="vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-4">
        <div class="border border-3 border-danger"></div>
        <div class="card  bg-white shadow p-5">
            <div class="mb-4 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-danger" width="75" height="75" fill="none"
                    viewBox="0 0 16 16">
                    <circle cx="8" cy="8" r="7.5" stroke="currentColor" />
                    <path d="M4.5 4.5L11.5 11.5M4.5 11.5L11.5 4.5" stroke="currentColor" />
                </svg>


            </div>
            <div class="text-center">
                <h1>Failed !</h1>
                <p>The payment was unsucessful ! </p>
                <a class="btn btn-outline-danger" href="/">Back Home</a>
            </div>
        </div>
    </div>
</div>
@endsection