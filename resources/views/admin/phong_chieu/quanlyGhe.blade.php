@extends('admin.layouts.master')
@section('noidung')
<div class="wrapper">
    <!-- Sidebar -->
    @include('admin.layouts.partials.sidebar')
    <!-- End Sidebar -->
    <style>
        .select2-dropdown {
            z-index: 10000;
        }

        .empty {
            background-color: transparent;
        }

        .more-seat {
            padding-top: 10px;
        }

        .more-seat span {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            border: 1px solid;
            cursor: pointer;
        }

        .icon-loading {
            position: absolute;
            width: 23px;
            height: 23px;
            border-radius: 50%;
            display: inline-block;
            border-top: 3px solid #FFF;
            border-right: 3px solid transparent;
            box-sizing: border-box;
            animation: rotation 1s linear infinite;
            top: 25%;
            left: 35%;
            transform: translate(-50%, -50%);
        }

        @keyframes rotation {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .loading {
            display: none;
            background-color: #515454;
            opacity: 0.55;
            top: 0;
            width: 100%;
            height: 100%;
            border-radius: 3px;
        }
    </style>
    <!-- nội dung -->
    <div class="main-panel">
        <div class="main-header">
            <div class="main-header-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="../index.html" class="logo">
                        <img src="{{ assert('kaiadmin-lite-1.2.0/assets/img/kaiadmin/logo_light.svg') }}"
                            alt="navbar brand" class="navbar-brand" />
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
            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                <div class="container-fluid">
                    <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button type="submit" class="btn btn-search pe-1">
                                    <i class="fa fa-search search-icon"></i>
                                </button>
                            </div>
                            <input type="text" placeholder="Search ..." class="form-control" />
                        </div>
                    </nav>

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
                            <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-envelope"></i>
                            </a>
                            <ul class="dropdown-menu messages-notif-box animated fadeIn"
                                aria-labelledby="messageDropdown">
                                <li>
                                    <div class="dropdown-title d-flex justify-content-between align-items-center">
                                        Messages
                                        <a href="#" class="small">Mark all as read</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="message-notif-scroll scrollbar-outer">
                                        <div class="notif-center">
                                            <a href="#">
                                                <div class="notif-img">
                                                    <img src="{{ assert('kaiadmin-lite-1.2.0/assets/img/jm_denis.jpg') }}"
                                                        alt="Img Profile" />
                                                </div>
                                                <div class="notif-content">
                                                    <span class="subject">Jimmy Denis</span>
                                                    <span class="block"> How are you ? </span>
                                                    <span class="time">5 minutes ago</span>
                                                </div>
                                            </a>
                                            <a href="#">
                                                <div class="notif-img">
                                                    <img src="{{ assert('kaiadmin-lite-1.2.0/assets/img/chadengle.jpg') }}"
                                                        alt="Img Profile" />
                                                </div>
                                                <div class="notif-content">
                                                    <span class="subject">Chad</span>
                                                    <span class="block"> Ok, Thanks ! </span>
                                                    <span class="time">12 minutes ago</span>
                                                </div>
                                            </a>
                                            <a href="#">
                                                <div class="notif-img">
                                                    <img src="{{ assert('kaiadmin-lite-1.2.0/assets/img/mlane.jpg') }}"
                                                        alt="Img Profile" />
                                                </div>
                                                <div class="notif-content">
                                                    <span class="subject">Jhon Doe</span>
                                                    <span class="block">
                                                        Ready for the meeting today...
                                                    </span>
                                                    <span class="time">12 minutes ago</span>
                                                </div>
                                            </a>
                                            <a href="#">
                                                <div class="notif-img">
                                                    <img src="{{ assert('kaiadmin-lite-1.2.0/assets/img/talha.jpg') }}"
                                                        alt="Img Profile" />
                                                </div>
                                                <div class="notif-content">
                                                    <span class="subject">Talha</span>
                                                    <span class="block"> Hi, Apa Kabar ? </span>
                                                    <span class="time">17 minutes ago</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a class="see-all" href="javascript:void(0);">See all messages<i
                                            class="fa fa-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item topbar-icon dropdown hidden-caret">
                            <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="notification">4</span>
                            </a>
                            <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                                <li>
                                    <div class="dropdown-title">
                                        You have 4 new notification
                                    </div>
                                </li>
                                <li>
                                    <div class="notif-scroll scrollbar-outer">
                                        <div class="notif-center">
                                            <a href="#">
                                                <div class="notif-icon notif-primary">
                                                    <i class="fa fa-user-plus"></i>
                                                </div>
                                                <div class="notif-content">
                                                    <span class="block"> New user registered </span>
                                                    <span class="time">5 minutes ago</span>
                                                </div>
                                            </a>
                                            <a href="#">
                                                <div class="notif-icon notif-success">
                                                    <i class="fa fa-comment"></i>
                                                </div>
                                                <div class="notif-content">
                                                    <span class="block">
                                                        Rahmad commented on Admin
                                                    </span>
                                                    <span class="time">12 minutes ago</span>
                                                </div>
                                            </a>
                                            <a href="#">
                                                <div class="notif-img">
                                                    <img src="" alt="Img Profile" />
                                                </div>
                                                <div class="notif-content">
                                                    <span class="block">
                                                        Reza send messages to you
                                                    </span>
                                                    <span class="time">12 minutes ago</span>
                                                </div>
                                            </a>
                                            <a href="#">
                                                <div class="notif-icon notif-danger">
                                                    <i class="fa fa-heart"></i>
                                                </div>
                                                <div class="notif-content">
                                                    <span class="block"> Farrah liked Admin </span>
                                                    <span class="time">17 minutes ago</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a class="see-all" href="javascript:void(0);">See all notifications<i
                                            class="fa fa-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item topbar-icon dropdown hidden-caret">
                            <a class="nav-link" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                                <i class="fas fa-layer-group"></i>
                            </a>
                            <div class="dropdown-menu quick-actions animated fadeIn">
                                <div class="quick-actions-header">
                                    <span class="title mb-1">Quick Actions</span>
                                    <span class="subtitle op-7">Shortcuts</span>
                                </div>
                                <div class="quick-actions-scroll scrollbar-outer">
                                    <div class="quick-actions-items">
                                        <div class="row m-0">
                                            <a class="col-6 col-md-4 p-0" href="#">
                                                <div class="quick-actions-item">
                                                    <div class="avatar-item bg-danger rounded-circle">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </div>
                                                    <span class="text">Calendar</span>
                                                </div>
                                            </a>
                                            <a class="col-6 col-md-4 p-0" href="#">
                                                <div class="quick-actions-item">
                                                    <div class="avatar-item bg-warning rounded-circle">
                                                        <i class="fas fa-map"></i>
                                                    </div>
                                                    <span class="text">Maps</span>
                                                </div>
                                            </a>
                                            <a class="col-6 col-md-4 p-0" href="#">
                                                <div class="quick-actions-item">
                                                    <div class="avatar-item bg-info rounded-circle">
                                                        <i class="fas fa-file-excel"></i>
                                                    </div>
                                                    <span class="text">Reports</span>
                                                </div>
                                            </a>
                                            <a class="col-6 col-md-4 p-0" href="#">
                                                <div class="quick-actions-item">
                                                    <div class="avatar-item bg-success rounded-circle">
                                                        <i class="fas fa-envelope"></i>
                                                    </div>
                                                    <span class="text">Emails</span>
                                                </div>
                                            </a>
                                            <a class="col-6 col-md-4 p-0" href="#">
                                                <div class="quick-actions-item">
                                                    <div class="avatar-item bg-primary rounded-circle">
                                                        <i class="fas fa-file-invoice-dollar"></i>
                                                    </div>
                                                    <span class="text">Invoice</span>
                                                </div>
                                            </a>
                                            <a class="col-6 col-md-4 p-0" href="#">
                                                <div class="quick-actions-item">
                                                    <div class="avatar-item bg-secondary rounded-circle">
                                                        <i class="fas fa-credit-card"></i>
                                                    </div>
                                                    <span class="text">Payments</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item topbar-user dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                                aria-expanded="false">
                                <div class="avatar-sm">
                                    <img src="" alt="..." class="avatar-img rounded-circle" />
                                </div>
                                <span class="profile-username">
                                    <span class="op-7">Hi,</span>
                                    <span class="fw-bold">Hizrian</span>
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <div class="user-box">
                                            <div class="avatar-lg">
                                                <img src="" alt="image profile" class="avatar-img rounded" />
                                            </div>
                                            <div class="u-text">
                                                <h4>Hizrian</h4>
                                                <p class="text-muted">hello@example.com</p>
                                                <a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View
                                                    Profile</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">My Profile</a>
                                        <a class="dropdown-item" href="#">My Balance</a>
                                        <a class="dropdown-item" href="#">Inbox</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Account Setting</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Logout</a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>

        <!-- start modal create seat -->
        <div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form id="form-create-seats" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm ghế cho phòng chiếu
                                <strong>{{ $phongChieu->ten_phong_chieu }}</strong>
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="seat-fields">
                                <div class="row create-seats-row" id="0">
                                    <div class="col-md-12 px-3">
                                        <div class="input-group input-group-static" style="padding: 0 12px;">
                                            <label for="exampleFormControlSelect1" style="width:100%;"
                                                class="ms-0 pt-3 pb-1">Hàng ghế</label>
                                            <select id="0" class="js-example-basic-seats-0 select-seat form-control"
                                                name="seats0[]" multiple="multiple" style="width:100%;" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 d-flex">
                                        <div class="form-group col-md-6">
                                            <label for="exampleFormControlSelect1">Loại ghế</label>
                                            <select class="form-select typeSeat typeSeat-0" name="typeSeat-0" id="0">
                                                <option value="thuong">Ghế Thường</option>
                                                <option value="vip">Ghế Vip</option>
                                                <option value="doi">Ghế Đôi</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email2">Số lượng</label>
                                            <input type="number" required class="form-control totalSeat totalSeat-0"
                                                id="0" name="totalSeat-0" min="0" max="12" style="padding: 4px 5px;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="more-seat d-flex justify-content-center">
                                <span id="create-input-seats"
                                    class="d-flex justify-content-center align-items-center"><i
                                        class="fas fa-plus"></i></span>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <div class="position-relative">
                                <button type="submit" id="btn-submitCreateSeats" class="btn btn-primary">Submit</button>
                                <div class="position-absolute loading">
                                    <div class="icon-loading"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end modal create seat -->

        <div class="container">
            <div class="page-inner">
                <div class="page-header">
                    <ul class="breadcrumbs">
                        <li class="nav-home">
                            <a href="{{ route('admin.phongChieu') }}">
                                <i class="icon-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="icon-arrow-right"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Danh sách ghế của phòng chiếu
                                <strong>{{ $phongChieu->ten_phong_chieu }}</strong></a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="container-seat" style="max-width: 83rem;">
                        <div class="mb-3"></div>
                        <div class="row">
                            <div class="col-lg-8 col-12">
                                <div class="seat-selection">
                                    <div class="legend">
                                        <div>
                                            <span class="selected"></span>
                                            <p>Ghế bạn chọn</p>
                                        </div>
                                    </div>
                                    <span class="front">Màn hình</span>
                                    <div class="seats-wrapper-parent">
                                        <div class="seats-wrapper-row">
                                            <div class="seats-row">
                                                <div class="row-wrapper">
                                                    <div class="seat-row">A</div>
                                                    <div class="seat-row">B</div>
                                                    <div class="seat-row">C</div>
                                                    <div class="seat-row">D</div>
                                                    <div class="seat-row">E</div>
                                                    <div class="seat-row">F</div>
                                                    <div class="seat-row">G</div>
                                                    <div class="seat-row">H</div>
                                                    <div class="seat-row">I</div>
                                                </div>
                                            </div>
                                            <div class="seats-map">
                                                <div class="row-wrapper list-row-seats">


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12 order-sm-last">
                                <div class="container-ticket-information bg-white">
                                    <div class="content-ticket-information d-flex w-full flex-wrap">
                                        <div class="ms-3">
                                            <button data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                class="btn btn-primary ">Thêm ghế</button>
                                        </div>
                                        <div class="position-relative ms-3">
                                            <button class="btn btn-danger btn-remoreSeat">Xoá ghế</button>
                                            <div class="position-absolute loading">
                                                <div class="icon-loading"></div>
                                            </div>
                                        </div>
                                        <div class="ms-3"><button class="btn btn-secondary">Sửa ghế</button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('jsCreateSeat')
@include('admin.phong_chieu.jqueySeat')
@endsection
<!-- jqueySeat -->
@endsection