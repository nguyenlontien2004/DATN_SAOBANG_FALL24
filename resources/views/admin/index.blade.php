@extends('admin.layouts.master')

@section('noidung')
<div class="wrapper">
    <!-- Sidebar -->
    @include('admin.layouts.partials.sidebar')
    <!-- End Sidebar -->

    <div class="main-panel">
        <div class="main-header">
            <div class="main-header-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="index.html" class="logo">
                        <img src="{{ asset('kaiadmin-lite-1.2.0/assets/img/kaiadmin/logo_light.svg') }}"
                            alt="navbar brand" class="navbar-brand" height="20" />
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
            <!-- End Logo Header -->
            <!-- Layout đúng khi sửa -->
            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                <div class="container-fluid">
                    <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                        <div class="input-group">
                            <!-- <div class="input-group-prepend">
                                <button type="button" class="btn btn-search pe-1" onclick="search()">
                                    <i class="fa fa-search search-icon"></i>
                                </button>
                            </div>
                            <input type="text" id="searchInput" placeholder="Tìm kiếm ..." class="form-control"
                                oninput="search()" /> -->
                        </div>
                    </nav>
                    <div id="searchResults"
                        style="position: absolute; left: 100px; padding: 5px; width: 100px; border: 1px solid #ccc; display: none;">
                    </div>
                    <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                        <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                                aria-expanded="false" aria-haspopup="true">
                                <i class="fa fa-search"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-search animated fadeIn">
                                <form class="navbar-left navbar-form nav-search">
                                    <div class="input-group">
                                        <input type="text" placeholder="Search ..." class="form-control" />
                                    </div>
                                </form>
                            </ul>
                        </li>
                        <li class="nav-item topbar-icon dropdown hidden-caret">
                          
                        </li>
                        <li class="nav-item topbar-icon dropdown hidden-caret">
                          
                        </li>
                        <li class="nav-item topbar-icon dropdown hidden-caret">
                        </li>
                        <li class="nav-item topbar-icon dropdown hidden-caret">
                          
                        </li>
                        @php
                            $user = Auth::user();
                        @endphp
                        <li class="nav-item topbar-user dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                                aria-expanded="false">
                                <div class="avatar-sm">
                                    <img src="{{ asset('storage/' . $user->hinh_anh) }}" alt="..."
                                        class="avatar-img rounded-circle" />
                                </div>
                                <span class="profile-username">
                                    <span class="op-7">Xin chào, {{ $user->ho_ten }}</span>
                                    {{-- <span class="fw-bold">{{ Auth::user()->ho_ten }}</span> --}}
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <div class="user-box">
                                            <div class="avatar-lg">
                                                <img src="{{ asset('storage/' . $user->hinh_anh) }}" alt="image profile"
                                                    class="avatar-img rounded" />
                                            </div>
                                            <div class="u-text">
                                                <h4>{{ $user->ho_ten }}</h4>
                                                <p class="text-muted">{{ $user->email }}</p>
                                                {{-- <a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View
                                                    Profile</a> --}}
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('tt.admin') }}">Hồ sơ của
                                            tôi</a>
                                        {{-- <a class="dropdown-item" href="#">My Balance</a>
                                        <a class="dropdown-item" href="#">Inbox</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Account Setting</a> --}}
                                        <div class="dropdown-divider"></div>
                                        <form action="{{ route('admin.dangxuat') }}" method="POST">
                                            @csrf
                                            <button class="btn btn-secondary btn-custom ms-2" type="submit">Đăng
                                                xuất</button>
                                        </form>
                                    </li>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>
        <!-- Layout đúng khi sửa -->
        <div class="container">
            @yield('content')
        </div>
    </div>

    @endsection