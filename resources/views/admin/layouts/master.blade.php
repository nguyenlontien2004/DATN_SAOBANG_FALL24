<!DOCTYPE html>
<html lang="en">
@include('admin.layouts.partials.head')

<body>
    <div class="wrapper">
        @include('admin.layouts.partials.sidebar')
        <div class="main-panel">

            @yield('noidung')
            @include('admin.layouts.partials.footer')
        </div>
    </div>
</body>

</html>
