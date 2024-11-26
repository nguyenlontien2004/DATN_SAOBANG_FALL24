@extends('layout.user')

@section('content')
    <div class="content">
        <div class="contetn_dk">
            <h2 class="title_dn text-center mb-4">ĐĂNG NHẬP</h2>
            <div class="main_dangnhap d-flex justify-content-center">
                <div class="content_form">
                    <div class="form mb-4">
                        <div class="content_dn">
                            <h3 class="title_dn1">Bạn đã có tài khoản trên Funny-Family</h3>
                            <p class="add_p1">
                                Nếu bạn đã có tài khoản, hãy đăng nhập để tích lũy điểm thành viên và nhận được những ưu đãi
                                tốt hơn!
                            </p>
                            <form action="{{ route('dangnhap') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input class="form-control" type="email" name="email" id="email"
                                        placeholder="Email..." required />
                                    @error('email')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Mật khẩu:</label>
                                    <input class="form-control" type="password" name="password" id="password"
                                        placeholder="Mật khẩu..." required />
                                    @error('password')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="bnt_reemem mb-3">
                                    <a href="{{ route('forgot.password') }}" class="quenmk">Bạn quên mật khẩu?</a>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Đăng nhập</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="form">
                        <div class="content_dn">
                            <h3 class="title_dn1">Khách hàng mới của Funny-Family</h3>
                            <div class="ct_dnp2">
                                <p class="add_p1">
                                    Nếu bạn chưa có tài khoản trên hệ thống của cửa hàng Funny-Family, mời bạn chọn vào nút
                                    đăng ký để trở thành thành viên mới.
                                </p>
                                <p class="add_p1">
                                    Bằng cách cung cấp thông tin chi tiết của bạn, quá trình mua hàng sẽ là một trải nghiệm
                                    thú vị và nhanh chóng hơn!
                                </p>
                            </div>
                            <div class="text-center mt-4">
                                <a href="{{ route('dangky') }}" class="btn btn-secondary">Đăng ký</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
