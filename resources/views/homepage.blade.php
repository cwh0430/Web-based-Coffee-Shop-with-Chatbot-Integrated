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

<body class="home-body">
    {{-- <section id="landing" class="bg-cover bg-section" style="background-image:url('img/coffee-landing-2.jpg');">
        --}}

        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel"
            data-bs-interval=4000>

            <div class="carousel-inner">
                <div class="carousel-item active item-background"
                    style="background-image:url('img/landingPage/slide-1.jpg');">
                    <div class="carousel-caption d-flex flex-column justify-content-center h-100" style="top: 0">
                        <h1 class="display-4 slide-caption">START YOUR DAY WITH A SIP OF PERFECTION</h1>
                        {{-- <p class="my-4 slide-desc">We provide you a wide range of coffee with the highest quality
                        </p> --}}
                    </div>
                </div>
                <div class="carousel-item item-background" style="background-image:url('img/landingPage/slide-2.jpg');">
                    <div class="carousel-caption d-flex flex-column justify-content-center h-100" style="top: 0;">
                        <h1 class="display-4 slide-caption">GRAB YOUR CUP OF DRINK NOW</h1>
                        <p class="my-4 slide-desc">Discover the irresistible allure of our premium beverage</p>
                        <a class="btn btn-readmore" href="/beveragelist">View Menu</a>
                    </div>
                </div>
                <div class="carousel-item item-background" style="background-image:url('img/landingPage/slide-3.jpg');">
                    <div class="carousel-caption d-flex flex-column justify-content-center h-100" style="top: 0">
                        <h1 class="display-4 slide-caption">ELEVATE YOUR HOMEBREW EXPERIENCE</h1>
                        <p class="my-4 slide-desc">Unleash the Essence of Coffee in the Comfort of Your Home With Our
                            Homebrew Coffee Products</p>
                        <a class="btn btn-readmore" href="/homebrewproductlist">Shop Now</a>

                    </div>
                </div>
                <div class="carousel-item item-background" style="background-image:url('img/landingPage/slide-4.jpg');">
                    <div class="carousel-caption d-flex flex-column justify-content-center h-100" style="top: 0">
                        <h1 class="display-4 slide-caption">INDULGE IN THE ART OF COFFEE</h1>
                        <p class="my-4 slide-desc">Craft Your Perfect Cup with Our Premium Barista Tools and Coffee
                            Machines</p>
                        <a class="btn btn-readmore" href="/mechaniclist">Shop Now</a>
                    </div>
                </div>
                <div class="carousel-item item-background" style="background-image:url('img/landingPage/slide-5.jpg');">
                    <div class="carousel-caption d-flex flex-column justify-content-center h-100" style="top: 0">
                        <h1 class="display-4 slide-caption">MASTER THE ART OF BREWING</h1>
                        <p class="my-4 slide-desc">Your Ultimate Guide to Unlock the Art of Crafting</p>
                        <a class="btn btn-readmore" href="/guide">View Guides</a>
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


        <section id="services">
            <div class="container">
                <div class="row">
                    <div class="col-12 service-intro text-center">
                        <h1 class="service-title">Our Products</h1>
                        <div class="divider"></div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 product-service responsive-space">
                        <div class="service-icon text-center">
                            <img src="/img/coffee-cup-icon.png" alt="CoffeeCup" class="coffee-cup">
                            <h5 class="service-caption">Beverages</h5>

                            {{-- <a href="/productslist" class="btn btn-view">View More</a> --}}

                        </div>
                    </div>

                    <div class="col-md-3 product-service responsive-space">
                        <div class="service-icon text-center">
                            <img src="/img/coffee-bean-icon.png" alt="CoffeeBean" class="coffee-bean">
                            <h5 class="service-caption">Homebrew Products</h5>
                            {{-- <p>wide range of brewing</p> --}}
                            {{-- <a href="/productslist" class="btn btn-view">View More</a> --}}

                        </div>
                    </div>
                    <div class="col-md-3 product-service responsive-space">
                        <div class="service-icon text-center">
                            <img src="/img/coffee-machine-icon.png" alt="CoffeeBean" class="coffee-bean">
                            <h5 class="service-caption">Gears</h5>
                            {{-- <p>wide range of gears</p> --}}
                            {{-- <a href="/productslist" class="btn btn-view">View More</a> --}}

                        </div>
                    </div>
                    <div class="col-md-3 product-service responsive-space">
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