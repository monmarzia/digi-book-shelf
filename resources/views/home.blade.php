<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Digi Book Shelf</title>
        @vite(['resources/sass/app.scss', 'resources/js/app.js'], '/css', '/js')
    </head>
    <body class="antialiased">
        <h1 class="text-center text-success fs-1 fw-bold mt-5">Digi Book Shelf</h1>
        <div id="app" class="">
            <router-view></router-view>            
        </div>            

    </body>
</html>
