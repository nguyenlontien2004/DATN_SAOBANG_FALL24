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
                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('resetpass') }}" method="POST">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <input type="email" name="email" class="form-controll" placeholder="Nhập email">
                                <input type="password" name="password" placeholder="Nhập mật khẩu mới">
                                <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu mới">
                                <button type="submit">Đặt lại mật khẩu</button>
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
