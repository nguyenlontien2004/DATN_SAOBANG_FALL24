@extends('layout.user')

@section('content')
    <div class="content">
        <div class="contetn_dk">
            <div class="text-center mt-4">
                <h2 class="display-4 text-primary font-weight-bold">ĐĂNG KÝ</h2>
            </div>
            <div class="h5tt text-star mt-3">
                <h5 class="text-secondary font-weight-normal">Thông tin khách hàng</h5>
            </div>

            <div class="main_dagnhap">
                <div class="content_form">
                    <div class="form">
                        <div class="content_dn">
                            <form action="{{ route('dangky') }}" method="POST">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="ho_ten">Họ và tên:</label>
                                    <input type="text" name="ho_ten" id="ho_ten" class="form-control"
                                        placeholder="Họ và Tên...">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Email...">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="so_dien_thoai">Số điện thoại:</label>
                                    <input type="text" name="so_dien_thoai" id="so_dien_thoai" class="form-control"
                                        placeholder="Số điện thoại...">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password">Mật khẩu:</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Mật khẩu...">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password_confirmation">Nhập lại mật khẩu:</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control" placeholder="Nhập lại mật khẩu...">
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Đăng ký</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="form">
                        <div class="content_dn">
                            <div class="img_dk">
                                <img src="#" alt="Logo" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
