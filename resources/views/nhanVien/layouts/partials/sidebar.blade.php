<div class="sidebar" data-background-color="dark">
    <!-- Sidebar Logo -->
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="light"
            style="display: flex; align-items: center; justify-content: space-between; padding: 10px;">
            <a href="index.html" class="logo" style="display: flex; align-items: center;">
                <img src="https://files.oaiusercontent.com/file-fzKrGiSjtFvjVxuESDMgtKKD?se=2024-10-30T04%3A57%3A16Z&sp=r&sv=2024-08-04&sr=b&rscc=max-age%3D604800%2C%20immutable%2C%20private&rscd=attachment%3B%20filename%3D54b5a2cd-b6e4-4fc4-9f8b-ef36090d88d8.webp&sig=IVUSPVuT5il78/tPX228UeRwLXuStxnPHMfeQOItmlo%3D"
                    alt="Sao Băng Logo" style="max-height: 50px;">
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
                        </ul>
                    </div>
                </li>
{{-- {{ route('ve.danh-sach-ve') }} --}}
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
            </ul>
        </div>
    </div>
</div>
