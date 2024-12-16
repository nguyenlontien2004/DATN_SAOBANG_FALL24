<div class="sidebar" data-background-color="dark">
    <!-- Sidebar Logo -->
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="light"
            style="display: flex; align-items: center; justify-content: space-between; padding: 10px;">
            <a href="" class="logo" style="display: flex; align-items: center;">
                <img src="{{ asset('storage/logo/5b4662d9-6a89-4608-a897-b138afa2975a-removebg-preview.png') }}"
                    alt="Sao Băng Logo" style="max-height: 60px;">
                <h5 class="mb-0" style="color: white;">Sao Băng</h5>
            </a>

            <!-- Toggle Buttons -->
            <div class="nav-toggle" style="display: flex; align-items: center;">
                <button class="btn btn-toggle toggle-sidebar" style="margin-right: 5px;">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>

            <!-- Topbar Toggler -->
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item active">
                    <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-chart-bar"></i>
                        <p>Thống kê</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="dashboard">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('thongke.vesbanra') }}">
                                    <span class="sub-item">Doanh thu theo phim</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('thongke.rap') }}">
                                    <span class="sub-item">Doanh thu theo rạp</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('thongke.theloai12') }}">
                                    <span class="sub-item">Doanh thu theo thể loại</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('thongke.doan') }}">
                                    <span class="sub-item">Doanh thu theo đồ ăn</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('thongke.nguoimua') }}">
                                    <span class="sub-item">Số lần người dùng mua vé</span>
                                </a>
                            </li>
                        </ul>

                    </div>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Thành phần</h4>
                </li>
                {{-- <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#base">
                        <i class="fas fa-folder"></i>
                        <p>Danh sách thể loại</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('theLoaiPhim.index') }}">
                                    <span class="sub-item">Danh Sách Thể Loại</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('theLoaiPhim.create') }}">
                                    <span class="sub-item">Thêm Mới Thể Loại</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route('theLoaiPhim.index') }}">
                        <i class="fas fa-layer-group"></i>
                        <p>Danh sách thể loại</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarLayouts">
                        <i class="fas fa-theater-masks"></i>
                        <p>Diễn viên & Đạo diễn</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('dienVien.index') }}">
                                    <span class="sub-item">Quản lý diễn viên</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('daoDien.index') }}">
                                    <span class="sub-item">Quản lý Đạo diễn</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#forms">
                        <i class="fas fa-film"></i>
                        <p>Quản lý phim</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="forms">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('phim.index') }}">
                                    <span class="sub-item">Quản lý phim</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('rap.index') }}">
                                    <span class="sub-item">Quản lý rạp chiếu</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.phongChieu') }}">
                                    <span class="sub-item">Quản lý phòng chiếu</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('suatChieu.index') }}">
                                    <span class="sub-item">Quản lý suất chiếu</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.chitietsuatchieu') }}">
                                    <span class="sub-item">Chi tiết suất chiếu</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{ route('nguoi-dung.index') }}">
                        <i class="fas fa-user"></i>
                        <p>Quản lý người dùng</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#danhgiabinhluan">
                        <i class="fas fa-user-tag"></i>
                        <p>Đánh giá & bình luận</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="danhgiabinhluan">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('admin.danhgia.index') }}">
                                        <span class="sub-item">Quản lý đánh giá</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.binhluan.index') }}">
                                        <span class="sub-item">Quản lý bình luận</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#food">
                        <i class="fas fa-utensils"></i>
                        <p>Quản lý đồ ăn</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="food">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('do-an.index') }}">
                                    <span class="sub-item">Danh sách đồ ăn</span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="">
                                    <span class="sub-item">Món ăn theo vé</span>
                                </a>
                            </li> -->
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.ticket.index') }}">
                        <i class="fas fa-ticket-alt"></i>
                        <p>Quản lý vé</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#charts">
                        <i class="fas fa-newspaper"></i>
                        <p>Bài viết tin tức</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="charts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('danh-muc-bai-viet-tin-tuc.index') }}">
                                    <span class="sub-item">Danh sách danh mục bài viết tin tức</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('bai-viet-tin-tuc.index') }}">
                                    <span class="sub-item">Danh sách bài viết tin tức</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#banner">
                        <i class="fas fa-flag"></i>
                        <p>Banner quảng cáo</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="banner">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('banner-quang-cao.index') }}">
                                    <span class="sub-item">Danh sách vị trí banner quảng cáo</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('anh-banner-quang-cao.index') }}">
                                    <span class="sub-item">Danh sách ảnh banner quảng cáo</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{ route('ma_giam_gia.index') }}">
                        <i class="fas fa-tags"></i>
                        <p>Mã giảm giá</p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ asset('kaiadmin-lite-1.2.0/widgets.html') }}">
                        <i class="fas fa-desktop"></i>
                        <p>Chương trình khuyến mãi</p>
                        <span class="badge badge-success">4</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#submenu">
                        <i class="fas fa-bars"></i>
                        <p>Menu Levels</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="submenu">
                        <ul class="nav nav-collapse">
                            <li>
                                <a data-bs-toggle="collapse" href="#subnav1">
                                    <span class="sub-item">Level 1</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="subnav1">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a data-bs-toggle="collapse" href="#subnav2">
                                    <span class="sub-item">Level 1</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="subnav2">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Level 1</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
            </ul>
        </div>
    </div>
</div>