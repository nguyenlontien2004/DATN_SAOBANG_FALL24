@extends('layout.user')

@section('content')
    <div class="content">

        <div class="contetn_dk">

            <div class="text-center">
                <h2 class="title_dn text-center mb-4">QUÊN MẬT KHẨU</h2>
            </div>

            <div class="main_dagnhap">
                <div class="content_form">
                    <div class="form">
                        <div class="content_dn">

                            <form action="{{ route('forgot.password') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="email" class="form-control" name="email" placeholder="Nhập email">
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Gửi link reset mật khẩu</button>
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
