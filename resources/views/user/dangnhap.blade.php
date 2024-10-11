@extends('layout.user')

@section('content')
    <div class="content">
        <div class="contetn_dk">
            <h2 class="title_dn">ĐĂNG NHẬP</h2>
            <div class="main_dagnhap">
                <div class="content_form">
                    <div class="form">
                        <div class="content_dn">
                            <h3 class="title_dn1">
                                Bạn đã có tài khoản trên Funny-Family
                            </h3>
                            <p class="add_p1">
                                Nếu bạn đã có tài khoản, hãy đăng nhập để tích lũy điểm
                                thành viên và nhận được những ưu đãi tốt hơn!
                            </p>
                            <form action="#">
                                <label for="">Email:</label>
                                <input class="ip_dk" type="text" name="" id="" placeholder="Email..." />
                                <br />
                                <label for="">Mật khẩu:</label>
                                <input class="ip_dk" type="text" name="" id=""
                                    placeholder="Mật khẩu..." />
                                <br />
                                <div class="bnt_reemem">
                                    <p class="quenmk">Bạn quên mật khẩu?</p>
                                </div>
                                <div class="bnt_dk3">
                                    <a href="index.html"><input class="bnt_dk" type="button" value="Đăng nhập" /></a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="form">
                        <div class="content_dn">
                            <h3 class="title_dn1">Khách hàng mới của Funny-Family</h3>
                            <div class="ct_dnp2">
                                <p class="add_p1">
                                    Nếu bạn chưa có tài khoản trên hệ thống của cửa hàng
                                    Funny-Family, mời bạn chọn vào nút đăng ký để trở thành
                                    thành viên mới của Funny-Family.
                                </p>
                                <p class="add_p1">
                                    Bằng cách cung cấp cho IVY moda thông tin chi tiết của
                                    bạn, quá trình mua hàng trên ivymoda.com sẽ là một trải
                                    nghiệm thú vị và nhanh chóng hơn!
                                </p>
                            </div>
                            <br />
                            <div class="bnt_dk3">
                                <a href="dangky.html"><input class="bnt_dk" type="button" value="Đăng ký" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
