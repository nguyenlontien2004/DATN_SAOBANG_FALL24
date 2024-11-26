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

    <main>
        <div class="container mb-3 mt-4">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-black text-white py-8">
        @include('user.partials.footer')
    </footer>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
