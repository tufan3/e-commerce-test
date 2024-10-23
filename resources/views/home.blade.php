<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .nav-link {
            color: #000;
            text-decoration: none;
        }

        .nav-link.active {
            color: #007bff;
            font-weight: bold;
            border-bottom: 2px solid #007bff;
        }

        .nav-link:hover {
            color: #0056b3;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('categories.index') ? 'active' : '' }}"
                                href="{{ route('categories.index') }}">All Category</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('subcategories.index') ? 'active' : '' }}"
                                href="{{ route('subcategories.index') }}">All Sub Category</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('products.index') ? 'active' : '' }}"
                                href="{{ route('products.index') }}">All Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('display.products') ? 'active' : '' }}"
                                href="{{ route('display.products') }}">Display Products</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @stack('scripts')
</body>

</html>
