@extends('layout.user')

@section('content')
    <div class="content">
        <div class="contetn_dk">
            <h2>ĐĂNG KÝ</h2>
            <div class="h5tt">
                <h5>Thông tin khách hàng</h5>
            </div>
            <div class="main_dagnhap">
                <div class="content_form">
                    <div class="form">
                        <div class="content_dn">
                            <form action="#">
                                <label for="">Họ và tên:</label>
                                <input class="ip_dk" type="text" name="" id=""
                                    placeholder="Họ và Tên..." />
                                <br />
                                <label for="">Email:</label>
                                <input class="ip_dk" type="text" name="" id="" placeholder="Email..." />
                                <br />
                                <label for="">Số điện thoại:</label>
                                <input class="ip_dk" type="text" name="" id=""
                                    placeholder="Số điện thoại..." />
                                <br />
                                <label for="">Địa chỉ:</label>
                                <input class="ip_dk" type="text" name="" id=""
                                    placeholder="Địa chỉ..." />
                                <br />
                                <label for="">Mật khẩu:</label>
                                <input class="ip_dk" type="text" name="" id=""
                                    placeholder="Mật khẩu..." />
                                <br />
                                <p class="yestk0">
                                    <a href="dangnhap.html">Bạn đã có tài khoản?</a>
                                </p>
                                <div class="bnt_dk3">
                                    <input class="bnt_dk" type="button" value="Đăng ký" />
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
