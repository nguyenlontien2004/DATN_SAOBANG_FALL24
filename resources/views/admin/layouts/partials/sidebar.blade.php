<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <span class="text-">Sao Băng</span>
            </a>
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
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
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="dashboard">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="../demo1/index.html">
                                    <span class="sub-item">Dashboard 1</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
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
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarLayouts">
                        <i class="fas fa-th-list"></i>
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
                        <i class="fas fa-pen-square"></i>
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
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#tables">
                        <i class="fas fa-table"></i>
                        <p>Quản lý nhân viên</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ asset('kaiadmin-lite-1.2.0/tables/tables.html') }}">
                                    <span class="sub-item">Basic Table</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ asset('kaiadmin-lite-1.2.0/tables/datatables.html') }}">
                                    <span class="sub-item">Datatables</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#role">
                        <i class="fas fa-table"></i>
                        <p>Người dùng & vai trò</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="role">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.role.index') }}">
                                    <span class="sub-item">Vai trò</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.roleAndUser.index') }}">
                                    <span class="sub-item">Phân quyền</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#food">
                        <i class="fas fa-table"></i>
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
                            <li>
                                <a href="">
                                    <span class="sub-item">Món ăn theo vé</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.ticket.index') }}">
                        <i class="fas fa-table"></i>
                        <p>Quản lý vé</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#charts">
                        <i class="far fa-chart-bar"></i>
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
                                <a href="{{ route('danh-muc-bai-viet-tin-tuc.create') }}">
                                    <span class="sub-item">Thêm danh mục bài viết tin tức</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('bai-viet-tin-tuc.index') }}">
                                    <span class="sub-item">Danh sách bài viết tin tức</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('bai-viet-tin-tuc.create') }}">
                                    <span class="sub-item">Thêm bài viết tin tức</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#banner">
                        <i class="far fa-chart-bar"></i>

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
                                <a href="{{ route('banner-quang-cao.create') }}">
                                    <span class="sub-item">Thêm vị trí banner quảng cáo</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('anh-banner-quang-cao.index') }}">
                                    <span class="sub-item">Danh sách ảnh banner quảng cáo</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('anh-banner-quang-cao.create') }}">
                                    <span class="sub-item">Thêm ảnh banner quảng cáo</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#km">
                        <i class="far fa-chart-bar"></i>
                        <p>Chương trình khuyến mãi</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="km">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('ma_giam_gia.index') }}">
                                    <span class="sub-item">Danh sách mã giảm giá</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('ma_giam_gia.create') }}">
                                    <span class="sub-item">Thêm mã giảm giá</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
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
                </li>
            </ul>
        </div>
    </div>
</div>
