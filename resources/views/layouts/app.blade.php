<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
@include('modules/header')
<body class="flex-wrapper">
    <main class="content-wrapper">
        @include('modules.alerts')
        @yield('content')
    </main>
    @include('modules/footer')
</body>
</html>
