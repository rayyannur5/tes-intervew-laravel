<!DOCTYPE html>
<html lang="en" class="bg-base-200">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
    @yield('link')
</head>
<body>
    <div class="container mx-auto pt-10 px-5">
        @yield('container')
    </div>
</body>
</html>