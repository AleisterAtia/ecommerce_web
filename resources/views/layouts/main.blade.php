<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <title>Responsive watches website - Bedimcode</title>
</head>

<body>

    @include('partials.header')

    @include('partials.cart')


    <main class="main">
        @yield('container') {{-- Tempat untuk konten dinamis dari halaman lain --}}
    </main>

    @include('partials.footer')

    <a href="#" class="scrollup" id="scroll-up">
        <i class='bx bx-up-arrow-alt scrollup__icon'></i>
    </a>

    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>

    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
