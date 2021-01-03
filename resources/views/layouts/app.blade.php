<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>App</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        @stack('styles')
        <link rel="stylesheet" href="{{ url('css/main.css') }}">
    </head>
<body>
    @yield('content')

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    @stack('scripts')
    <script src="{{ url('js/main.js') }}"></script>
</body>
</html>