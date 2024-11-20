<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>

    <body class="antialiased">
        <div id="app">
            <header>
                <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                    <div class="container">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="/images/fig_church.png" class="h-8 " alt="FIG-LOGO" style="width: 100px"/>
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav me-auto">

                            </ul>

                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ms-auto">
                                <!--------All Links-------->
                                <li class="nav-item">
                                        <a class="nav-link" href="#"  style="cursor: pointer;">{{ __('About Us') }}</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#" style="cursor: pointer;">{{ __('Events') }}</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#" style="cursor: pointer;">{{ __('Sermons') }}</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#" style="cursor: pointer;">{{ __('Contact Us') }}</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#" style="cursor: pointer;">{{ __('Give') }}</a>
                                    </li>

                                    <!-- <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            Test
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                            <a class="dropdown-item">
                                                {{ __('Account') }}
                                            </a>

                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li> -->

                                <!-- Authentication Links -->
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>

            <main>
                <!----Here Images / Carousel----->
                <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="/images/hero/hero_image.jpg" alt="" class="img-fluid mobile-max-height desktop-max-size ratio ratio-21x9">
                            <div class="container">
                            <div class="carousel-caption text-start">lll
                                <!-- <h1>Example headline.</h1>
                                <p class="opacity-75">Some representative placeholder content for the first slide of the carousel.</p> -->
                                <!-- <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p> -->
                            </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="/images/hero/hero_image_2.jpg" alt="" class="img-fluid mobile-max-height desktop-max-size">
                            <div class="container">
                            <div class="carousel-caption">
                                <!-- <h1>Another example headline.</h1>
                                <p>Some representative placeholder content for the second slide of the carousel.</p>
                                <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p> -->
                            </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                        <img src="/images/hero/hero_image_3.jpg" alt="" class="img-fluid mobile-max-height desktop-max-size fill-images">
                            <div class="container">
                            <div class="carousel-caption text-end">
                                <!-- <h1>One more for good measure.</h1>
                                <p>Some representative placeholder content for the third slide of this carousel.</p>
                                <p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p> -->
                            </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <!----Information gutter here--->
                <div class="card" style="width: 100%;">
                    <div class="card-body text-monospace">
                        <h5 class="card-title text-center font-weight-bold">Welcome To Faith In God Ministries USA</h5>
                        <div class="d-flex justify-content-center">
                            <a href="#" class="btn btn-primary align-center">Learn More About US</a>
                        </div>  
                    </div>
                </div>
                
            </main>
        </div>
    </body>
</html>


<style>

.bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
    }

    @media (min-width: 768px) {
    .bd-placeholder-img-lg {
        font-size: 3.5rem;
    }
}

/***Mobile Max Height* */
@media only screen and (max-width: 768px) {
  /* For mobile phones: */
    .mobile-max-height {
        max-height: 250px;
    }

    .fill-images{
        width: 100%;
    }
}

/***Desktop Max Height 1920 x 950* */
@media (min-width: 768px) {
    .desktop-max-size{
        width: 1920px;
        height: 950px;
    }
}

</style>
