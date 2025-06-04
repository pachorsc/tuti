<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tuti</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    <script src="http://cdn.tailwindcss.com"></script>

</head>

<body class="overflow-x-hidden">
    <header>
        <x-menu></x-menu>
    </header>
    <main>
        <h1>Reservar Prosducto o Servicios</h1>
        <h2>{{$nombre}}</h2>
        <h3>{{$id}}</h3>
    </main>

    <footer>
        <x-footer></x-footer>
    </footer>
</body>

</html>