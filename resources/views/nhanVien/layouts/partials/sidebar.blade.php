<div class="sidebar" data-background-color="dark">
    <!-- Sidebar Logo -->
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="light"
            style="display: flex; align-items: center; justify-content: space-between; padding: 10px;">
            <a href="" class="logo" style="display: flex; align-items: center;">
                <img src="{{ asset('storage/logo/5b4662d9-6a89-4608-a897-b138afa2975a-removebg-preview.png') }}"
                    alt="Sao Băng Logo" style="max-height: 60px;">
                    <h5 class="mb-0" style="color: white;" >Sao Băng</h5>
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
                    <a href="{{ route('nhanvientheLoaiPhim.index') }}">
                    <i class="fas fa-layer-group"></i>
                        <p>Thể loại phim</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a 
                    data-bs-toggle="collapse" href="#daodiendienvien">
                    <i class="fas fa-theater-masks"></i>
                        <p>Diễn viên & Đạo diễn</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="daodiendienvien">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('nhanviendienVien.index') }}">
                                    <span class="sub-item">Quản lý diễn viên</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('nhanviendaoDien.index') }}">
                                    <span class="sub-item">Quan lý đạo diễn</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a 
                    data-bs-toggle="collapse" href="#phim">
                    <i class="fas fa-film"></i>
                        <p>Quản lý phim</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="phim">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('nhanvienphim.index') }}">
                                    <span class="sub-item">Quản lý phim</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('nhanvienSuatchieu.index') }}">
                                    <span class="sub-item">Quan lý suất chiếu</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#baiviet">
                    <i class="fas fa-newspaper"></i>
                        <p>Bài viết và tin tức</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="baiviet">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('danh-muc-bai-viet-tin-tuc-nv.index') }}">
                                    <span class="sub-item">Danh mục bài viết và tin tức</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('bai-viet-tin-tuc-nv.index') }}">
                                    <span class="sub-item">Danh sách bài viết và tin tức</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#danhgiabinhluan">
                    <i class="fas fa-newspaper"></i>
                        <p>Đánh giá & Bình luận</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="danhgiabinhluan">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('nhanvien.danhgia.index') }}">
                                    <span class="sub-item">Quản lý đánh giá</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('nhanvien.binhluan.index') }}">
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
                                <a href="{{ route('nhanvien.do-an.index') }}">
                                    <span class="sub-item">Danh sách đồ ăn</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#ve">
                        <i class="fas fa-ticket-alt"></i>
                        <p>Quản lý vé</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="ve">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('nhanvien.ve.danhsachve') }}">
                                    <span class="sub-item">Danh sách vé</span>
                                </a>
                            </li>
                         
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#checkve">
                        <i class="fas fa-ticket-alt"></i>
                        <p>Kiểm tra vé</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="checkve">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('nhanvien.quetve') }}">
                                    <span class="sub-item">Quét vé</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('nhanvien.quetdoan') }}">
                                    <span class="sub-item">Quét đồ ăn</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>