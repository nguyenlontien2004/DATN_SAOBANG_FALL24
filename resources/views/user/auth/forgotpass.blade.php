@extends('layout.user')

@section('content')
    <div class="content">

        <div class="contetn_dk">

            <div class="text-center mt-4">
                <h2 class="display-4 text-primary font-weight-bold">For</h2>
            </div>

            <div class="main_dagnhap">
                <div class="content_form">
                    <div class="form">
                        <div class="content_dn">

                            <form action="{{ route('forgot.password') }}" method="POST">
                                @csrf
                                <input type="email" name="email" placeholder="Nhập email">
                                <button type="submit">Gửi link reset mật khẩu</button>
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
