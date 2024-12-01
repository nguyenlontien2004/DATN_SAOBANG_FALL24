<html lang="en"
    class="wf-publicsans-n3-active wf-publicsans-n4-active wf-publicsans-n5-active wf-publicsans-n6-active wf-publicsans-n7-active wf-fontawesome5solid-n4-active wf-fontawesome5regular-n4-active wf-fontawesome5brands-n4-active wf-simplelineicons-n4-active wf-active">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Đăng nhập nhân viên - Hệ thống quản lý</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport">
    <!-- <link rel="icon" href="kaiadmin-lite-1.2.0/assets/img/kaiadmin/favicon.ico" type="image/x-icon"> -->

    <!-- Fonts and icons -->
    <script src="{{ asset('kaiadmin-lite-1.2.0/assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Public+Sans:300,400,500,600,700" media="all">
    <link rel="stylesheet" href="{{ asset('kaiadmin-lite-1.2.0/assets/css/fonts.min.css') }}" media="all">
    <script>
        WebFont.load({
            google: {
                "families": ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                "families": ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ["{{ asset('kaiadmin-lite-1.2.0/assets/css/fonts.min.css') }}"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('kaiadmin-lite-1.2.0/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('kaiadmin-lite-1.2.0/assets/css/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('kaiadmin-lite-1.2.0/assets/css/kaiadmin.min.css') }}">
</head>
<style>
    .inputAuth {
        width: 100%;
        line-height: 1.5;
        padding-top: 1rem;
        padding-right: 1rem;
        padding-bottom: 1rem;
        padding-left: 1rem;
        border-radius: 5px;
        background: transparent;
        border: 1px solid #e7dede;
        color: white;
    }

    .mr {
        margin-left: 12px;
    }

    .error-message {
        color: red;
        font-size: 14px;
        margin-top: 10px;
    }
</style>

<body class="login"
    style="background-image: url('https://assets.nflxext.com/ffe/siteui/vlv3/74d734ca-0eab-4cd9-871f-bca01823d872/web/VN-vi-20241021-TRIFECTA-perspective_96a4f47f-aaa1-4b9a-b38b-919c90b66b80_large.jpg');
  backdrop-filter: brightness(0.5);background-repeat: no-repeat;background-size: cover;background-position: center;">
    <div class="wrapper wrapper-login">
        <!-- Đăng nhập tài khoản -->
        <div class="container container-login animated fadeIn"
            style="display: block;background: rgba(0, 0, 0, 0.7);color:white;border:none;">
            <h3 class="fs-1 fw-bolder">Đăng nhập nhân viên</h3>
            <div class="login-form">

                <form action="{{ route('nhanvien.form') }}" method="post">
                    @csrf
                    <div class="form-sub">
                        <div class="mb-3">
                            <input name="email" value="{{ old('email') }}" type="text" class="inputAuth"
                                placeholder="Email nhân viên" required>
                            @error('email')
                                <small id="emailHelp2"
                                    class="form-text text-muted text-danger pt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3" style="position:relative;">
                            <input id="password" name="password" value="{{ old('password') }}" type="password"
                                class="inputAuth inputPasLogin" placeholder="Mật khẩu" style="padding-right: 40px;"
                                required>

                            <div class="show-password show-passwordLogin d-flex align-items-center">
                                <i class="icon-eye iconEyeLogin" style="display: none"></i>
                                <svg class="iconEyeOffLogin" xmlns="http://www.w3.org/2000/svg" width="22"
                                    height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-eye-off">
                                    <path
                                        d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49" />
                                    <path d="M14.084 14.158a3 3 0 0 1-4.242-4.242" />
                                    <path
                                        d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143" />
                                    <path d="m2 2 20 20" />
                                </svg>
                            </div>

                            @error('password')
                                <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-1">
                            @if ($errors->has('error'))
                                <small id="emailHelp2"
                                    class="form-text text-muted text-danger">{{ $errors->first('error') }}</small>
                            @endif

                            <!-- Thông báo nếu không phải admin -->
                            @if (session('not_admin'))
                                <small class="error-message">
                                    Bạn không có quyền truy cập vào hệ thống này. Vui lòng liên hệ quản trị viên.
                                </small>
                            @endif
                        </div>
                    </div>
                    <div class="form-action pt-2">
                        <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JS Files -->
    <script src="{{ asset('kaiadmin-lite-1.2.0/assets/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('kaiadmin-lite-1.2.0/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('kaiadmin-lite-1.2.0/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('kaiadmin-lite-1.2.0/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('kaiadmin-lite-1.2.0/assets/js/ready.min.js') }}"></script>

</body>
</html>
