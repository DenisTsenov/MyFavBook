<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.partials._head')
</head>
<body>
    <div id="app">
        <div class="container">
            @include('layouts.partials._nav')
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>
    @include('layouts.partials._footer')
</body>
</html>
