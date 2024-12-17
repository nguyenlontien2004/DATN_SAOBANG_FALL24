@extends('admin.index')

@section('content')

    <style>
        .select2-dropdown {
            z-index: 10000;
        }

        .takenSeat {
            z-index: 100;
        }

        .seat-group-parent {
            margin-bottom: 3px;
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
                                            id="0" name="totalSeat-0" min="0" max="12"
                                            style="padding: 4px 5px;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="more-seat d-flex justify-content-center">
                            <span id="create-input-seats" class="d-flex justify-content-center align-items-center"><i
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

    <!-- start modal edit seat -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Sửa ghế</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="seat-selection">
                        <div class="seats-wrapper-parent">
                            <div class="seats-wrapper-row">
                                <div class="row-wrapper list-type-seat">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex mt-2 flex-column">
                            <label for="exampleFormControlSelect1" class="mb-1" style="width:100%;">Loại
                                ghế</label>
                            <select class="form-select typeSeatedit ">
                                <option value="0" selected>Chọn loại ghế cần chỉnh</option>
                                <option value="thuong">Ghế Thường</option>
                                <option value="vip">Ghế Vip</option>
                                <option value="doi">Ghế Đôi</option>
                            </select>
                        </div>
                        <small class="warning text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-submitEditSeat">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal edit seat -->

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
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.ghekhoiphuc',$phongChieu->id) }}">Danh sách ghế ẩn</a>
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
                                <div class="content-ticket-information d-flex w-full flex-wrap ">
                                    <div class="ms-2 mt-1">
                                        <button data-bs-toggle="modal" data-bs-target="#exampleModal"
                                            class="btn btn-primary ">Thêm ghế</button>
                                    </div>
                                    <div class="position-relative ms-2 mt-1">
                                        <button class="btn btn-danger btn-remoreSeat">Ẩn ghế</button>
                                        <div class="position-absolute loading">
                                            <div class="icon-loading"></div>
                                        </div>
                                    </div>
                                    <div class="ms-2 mt-1 btn-group">
                                        <button id="btnGroupDrop1" class="btn btn-secondary dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Sửa ghế
                                        </button>
                                        <ul class="dropdown-menu" id="editTypeSeat" aria-labelledby="btnGroupDrop1">
                                            <li data-type="thuong"><a class="dropdown-item" style="cursor:pointer">Ghế
                                                    Thường</a></li>
                                            <li data-type="vip"><a class="dropdown-item" style="cursor:pointer">Ghế
                                                    Vip</a></li>
                                            <li data-type="doi"><a class="dropdown-item" style="cursor:pointer">Ghế
                                                    Đôi</a></li>
                                        </ul>
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
