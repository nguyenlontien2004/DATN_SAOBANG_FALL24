<!DOCTYPE html>
<html lang="en">
@include('admin.layouts.partials.head') <!-- Include phần head -->

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('admin.layouts.partials.sidebar') <!-- Include phần sidebar -->
        <!-- End Sidebar -->

        <div class="main-panel p-5">
            <!-- Nội dung chính của trang -->
            @yield('noidung') <!-- Đây là nơi nội dung chính của mỗi trang sẽ được hiển thị -->

            <!-- Footer -->
            @include('admin.layouts.partials.footer') <!-- Include phần footer -->
            <!-- End Footer -->
        </div>
    </div>
</body>

</html>
