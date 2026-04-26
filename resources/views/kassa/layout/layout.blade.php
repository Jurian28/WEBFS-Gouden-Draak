<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @routes
    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])
</head>

<body>
@include('kassa.layout.navbar')
@yield('content')
</body>
</html>
