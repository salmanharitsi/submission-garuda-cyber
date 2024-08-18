<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-[#f5f5f5]">

    {{-- Navbar Section --}}
    @include('components.navbar')

    {{-- Register Livewire Component --}}
    @livewire('register-user')

    @livewireScripts
</body>

</html>
