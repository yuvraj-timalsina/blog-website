<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content="Yv"/>
    <title> {{ config('app.name', 'Blog Website')}} </title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('blog/css/styles.css') }}" rel="stylesheet"/>
    <!-- Boxicons CDN-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"/>
    @livewireStyles
</head>
<body>
<!-- Responsive navbar-->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{route('welcome')}}">
            {{config('app.name', 'Blog Website')}}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @auth
                    <li class="nav-item"><a class="nav-link" target="_blank" href="{{route('dashboard')}}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </li>
                @endauth

                @guest
                    <li class="nav-item"><a class="nav-link" href="{{route('login')}}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('register')}}">Register</a></li>
                @endguest
            </ul>

        </div>
    </div>
</nav>
<!-- Page header with logo and tagline-->
<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">  @yield('header') </h1>
        </div>
    </div>
</header>
<!-- Page content-->
@yield('content')
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright
            &copy; {{ config('app.name', 'Blog Website')}} {{date('Y')}}</p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{ asset('blog/js/scripts.js') }}"></script>
@livewireScripts
</body>
</html>
