<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}" type="text/css">
        @yield('styles')
        <title>YOTA - @yield('title')</title>
    </head>
    <body>
        @yield('navbar', View::make('inc.navbar'))
        @yield('jumbotron')
        <div class="container pt-3">
            @yield('content')
        </div>
        <script src="{{ mix('js/manifest.js') }}"></script>
        <script src="{{ mix('js/vendor.js') }}"></script>
        <script src="{{ mix('js/app.js') }}"></script>
        @yield('scripts')
    </body>
</html>
