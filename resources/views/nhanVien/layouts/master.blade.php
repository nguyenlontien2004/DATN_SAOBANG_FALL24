<!DOCTYPE html>
<html lang="en">
@include('nhanVien.layouts.partials.head') <!-- Include phần head -->

<body>
    @yield('noidung')
    @include('nhanVien.layouts.partials.footer')
    @yield('script-libs')
    @yield('jsCreateSeat')
    @yield('scripts')
</body>

</html>