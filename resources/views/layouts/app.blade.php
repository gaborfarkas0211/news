<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
</head>
<body>
<div class="page-wrap">
    @include('layouts.header')
    <div class="container">
        @include('layouts.response')
        @yield('content')
    </div>
</div>

@include('layouts.footer')
</body>

@vite(['resources/js/app.js'])
@yield('script')
</html>
