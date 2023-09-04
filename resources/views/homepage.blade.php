@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
    $('.carousel').carousel();
  });
    </script>
</head>

<body>
    {{-- <section id="landing" class="bg-cover bg-section" style="background-image:url('img/coffee-landing-2.jpg');">
        --}}

        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel"
            data-bs-interval=4000>
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3"
                    aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4"
                    aria-label="Slide 5"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active item-background"
                    style="background-image:url('img/landingPage/slide-1.jpg');">
                    <div class="carousel-caption d-flex flex-column justify-content-center h-100" style="top: 0">
                        <h1 class="display-4 slide-1-caption">START YOUR DAY WITH A SIP OF PERFECTION</h1>
                        {{-- <p class="my-4 slide-desc">We provide you a wide range of coffee with the highest quality
                        </p> --}}
                    </div>
                </div>
                <div class="carousel-item item-background" style="background-image:url('img/landingPage/slide-2.jpg');">
                    <div class="carousel-caption d-flex flex-column justify-content-center h-100" style="top: 0;">
                        <h1 class="display-4 slide-2-caption">GRAB YOUR CUP OF DRINK NOW</h1>
                        <p class="my-4 slide-desc">Discover the irresistible allure of our premium beverage</p>
                        <button class="btn-readmore">View Menu</button>
                    </div>
                </div>
                <div class="carousel-item item-background" style="background-image:url('img/landingPage/slide-3.jpg');">
                    <div class="carousel-caption d-flex flex-column justify-content-center h-100" style="top: 0">
                        <h1 class="display-4 slide-1-caption">ELEVATE YOUR HOMEBREW EXPERIENCE</h1>
                        <p class="my-4 slide-desc">Unleash the Essence of Coffee in the Comfort of Your Home With Our
                            Homebrew Coffee Products</p>
                        <button class="btn-readmore">Shop Now</button>

                    </div>
                </div>
                <div class="carousel-item item-background" style="background-image:url('img/landingPage/slide-4.jpg');">
                    <div class="carousel-caption d-flex flex-column justify-content-center h-100" style="top: 0">
                        <h1 class="display-4 slide-1-caption">INDULGE IN THE ART OF COFFEE</h1>
                        <p class="my-4 slide-desc">Craft Your Perfect Cup with Our Premium Barista Tools and Coffee
                            Machines</p>
                        <button class="btn-readmore">Shop Now</button>
                    </div>
                </div>
                <div class="carousel-item item-background" style="background-image:url('img/landingPage/slide-5.jpg');">
                    <div class="carousel-caption d-flex flex-column justify-content-center h-100" style="top: 0">
                        <h1 class="display-4 slide-1-caption">MASTER THE ART OF BREWING</h1>
                        <p class="my-4 slide-desc">Your Ultimate Guide to Unlock the Art of Crafting</p>
                        <button class="btn-readmore">View Guides</button>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                data-bs-slide="prev">
                <i class="fa-solid fa-arrow-left-long"></i>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                data-bs-slide="next">
                <i class="fa-solid fa-arrow-right-long"></i>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        {{-- <div class="overlay"></div>
        <div class="container text-white text-center">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h1 class="display-4">Start your day with a sip of perfection.</h1>
                    <p class="my-4">We provides you a wide range of coffee with the highest quality</p>

                    {{-- <div class="d-flex justify-content-center">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search">
                            <div class="input-group-append">
                                <button class="btn btn-search" id="basic-addon2"><i
                                        class="fa-solid fa-magnifying-glass search-icon"></i></button>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <a href="#" class="btn btn-main">View More</a> --}}
                    {{--
                </div>
            </div>
        </div> --}}




        <section id="services">
            <div class="container">
                <div class="row">
                    <div class="col-12 service-intro text-center">
                        <h1 class="service-title">Our Products</h1>
                        <div class="divider"></div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 product-service">
                        <div class="service-icon text-center">
                            <img src="/img/coffee-cup-icon.png" alt="CoffeeCup" class="coffee-cup">
                            <h5 class="service-caption">Beverages</h5>

                            {{-- <a href="/productslist" class="btn btn-view">View More</a> --}}

                        </div>
                    </div>

                    <div class="col-md-3 product-service">
                        <div class="service-icon text-center">
                            <img src="/img/coffee-bean-icon.png" alt="CoffeeBean" class="coffee-bean">
                            <h5 class="service-caption">Homebrew Products</h5>
                            {{-- <p>wide range of brewing</p> --}}
                            {{-- <a href="/productslist" class="btn btn-view">View More</a> --}}

                        </div>
                    </div>
                    <div class="col-md-3 product-service">
                        <div class="service-icon text-center">
                            <img src="/img/coffee-machine-icon.png" alt="CoffeeBean" class="coffee-bean">
                            <h5 class="service-caption">Gears</h5>
                            {{-- <p>wide range of gears</p> --}}
                            {{-- <a href="/productslist" class="btn btn-view">View More</a> --}}

                        </div>
                    </div>
                    <div class="col-md-3 product-service">
                        <div class="service-icon text-center">
                            <img src="/img/coffee-guiding-icon.png" alt="CoffeeBean" class="coffee-cup">
                            <h5 class="service-caption">Guiding Materials</h5>
                            {{-- <p>wide range of Materials</p> --}}
                            {{-- <a href="/guide" class="btn btn-view">View More</a> --}}

                        </div>
                    </div>
                </div>


            </div>

            @include('chatbot.chatbot')

        </section>
</body>

</html>







@endsection