<!DOCTYPE html>

<html lang="en">

@include('admin.layouts.partials.head') <!-- Include phần head -->

<body>

    @yield('noidung')

    @include('admin.layouts.partials.footer')

    @yield('jsCreateSeat')

    @yield('script-libs')

    @yield('scripts')

</body>

</html>
