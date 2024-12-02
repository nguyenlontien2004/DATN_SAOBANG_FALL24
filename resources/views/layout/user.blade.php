<!DOCTYPE html>
<html lang="en">
    <title>
        @yield('title')
    </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
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

    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/locale/vi.min.js"></script>
</body>

</html>
