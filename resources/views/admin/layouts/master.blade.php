<!DOCTYPE html>
<html lang="en">
@include('admin.layouts.partials.head') <!-- Include phần head -->

<body>
    <div class="wrapper">
        @include('admin.layouts.partials.sidebar')
        <div class="main-panel">

            @yield('noidung')
            @include('admin.layouts.partials.footer')
                @yield('jsCreateSeat')
        </div>
    </div>
</body>

</html>
