@extends('layouts.app')
@section('content')
<link href="{{ asset('css/order.css') }}" rel="stylesheet">

<div class="container-fluid mb-5">
    <div class="col-12">
        <div class="col-xl-9 col-lg-9 col-md-10 col-sm-10 col-11 mx-auto mt-5">
            @if (count($orders))
            <div class="accordion">
                @foreach ($orders as $item)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{$item->id}}" aria-expanded="true"
                            aria-controls="collapse-{{$item->id}}">
                            Order #{{$item->id}}
                            @if ($item->status == "unpaid")
                            <p class="text-unpaid-outline">Unpaid</p>
                            <button class="btn btn-primary">Pay Now</button>
                            @else
                            <p class="text-paid-outline">Paid</p>
                            @endif
                        </button>
                    </h2>
                    <div id="collapse-{{$item->id}}" class="accordion-collapse collapse show"
                        aria-labelledby="heading-{{$item->id}}" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="col-12">
                                <p class="total-price-title text-end">Total: RM{{number_format($item->total_price,2,
                                    '.')}}</p>
                            </div>

                            @foreach ($item->related as $detail)

                            <hr>
                            <div class="col-12">
                                <div
                                    class="row d-xl-flex d-lg-flex d-md-flex align-items-center justify-content-center d-none d-sm-none d-md-block d-lg-block d-xl-block">
                                    <div class="col-xl-2 col-lg-2 col-md-2">
                                        <img src="/storage/{{$detail->itemable->img}}"
                                            style="width: 100%; height:100%; object-fit:cover;"
                                            alt="Generic placeholder image" class="img-fluid">
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 d-flex justify-content-center text-center">
                                        <div>
                                            <p class=" mb-0">{{ucwords($detail->itemable->name)}}</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 d-flex justify-content-center text-center">
                                        <div>

                                            <p class="mb-0">Quantity:{{$detail->quantity}}</p>
                                        </div>
                                    </div>

                                    <div class="col-xl-2 col-lg-2 col-md-2 d-flex justify-content-center text-center">
                                        <div>
                                            <p class="mb-0" id="total-price">
                                                Price: RM{{number_format($detail->sub_price,2,
                                                '.')}}</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 mt-3 d-flex flex-column text-center ps-0">
                                        @if ($detail->customization)
                                        @foreach (json_decode($detail->customization) as $key => $value)

                                        <p class="text-muted customization mb-0">
                                            {{ ucwords(implode(' ',preg_split('/(?=[A-Z])/', $key))) }}:
                                            {{ ucwords(implode(' ',preg_split('/(?=[A-Z])/', $value))) }}
                                        </p>
                                        @endforeach
                                        @endif
                                    </div>

                                </div>

                                <div
                                    class="d-flex d-sm-flex align-items-center d-block d-sm-block d-xl-none d-md-none d-lg-none">
                                    <div class="col-3 col-sm-3">
                                        <img src="/storage/{{$detail->itemable->img}}"
                                            style="width: 100%; height:100%; object-fit:cover;"
                                            alt="Generic placeholder image" class="img-fluid">
                                    </div>
                                    <div class="row d-flex d-sm-flex flex-column flex-sm-column col-8 ms-1">
                                        <div class="col-12 col-sm-12 d-flex d-sm-flex justify-content-start ms-2">
                                            <div>
                                                <p class="mb-0">{{ucwords($detail->itemable->name)}}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row col-12">
                                            <div
                                                class="col-sm-8 col-8 d-flex d-sm-flex mt-2 ms-2 justify-content-start">
                                                @if (!empty(json_decode($detail->customization)))

                                                <p class="text-muted customization mb-0">
                                                    @foreach (json_decode($detail->customization) as $key => $value)
                                                    {{ ucwords(implode(' ',preg_split('/(?=[A-Z])/', $key))) }}:
                                                    {{ ucwords(implode(' ',preg_split('/(?=[A-Z])/', $value))) }}
                                                    @endforeach
                                                </p>

                                                @endif
                                            </div>
                                            <div class="col-4 col-sm-4 d-flex d-sm-flex justify-content-end ms-2 mt-2">
                                                <p class="mb-0">x{{$detail->quantity}}</p>
                                            </div>
                                        </div>

                                        <div class=" d-flex d-sm-flex justify-content-end mt-2 pe-0">
                                            <div>
                                                <p class="mb-0">RM{{number_format($detail->itemable->price,2,
                                                    '.')}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div>
                <p class="text-muted">No order history</p>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection