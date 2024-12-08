<!DOCTYPE html>
<html lang="en">

<head>
    @include('user.partials.head')
</head>

<body>

    <header>
        <div class="header-top">
            @include('user.partials.header-top')
        </div>

    </header>
    {{-- <div class="header-main">
        @include('user.partials.slide')
    </div>
     --}}
    <main>
        @yield('content')
    </main>



    <!-- Footer -->
    <footer class="bg-black text-white py-8">
        @include('user.partials.footer')
    </footer>

    @vite('resources/js/magiamgia.js')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
