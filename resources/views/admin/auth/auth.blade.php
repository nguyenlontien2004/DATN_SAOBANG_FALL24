<html lang="en"
    class="wf-publicsans-n3-active wf-publicsans-n4-active wf-publicsans-n5-active wf-publicsans-n6-active wf-publicsans-n7-active wf-fontawesome5solid-n4-active wf-fontawesome5regular-n4-active wf-fontawesome5brands-n4-active wf-simplelineicons-n4-active wf-active">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login &amp; Register - Kaiadmin Bootstrap 5 Admin Dashboard</title>
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
</style>

<body class="login"
    style="background-image: url('https://assets.nflxext.com/ffe/siteui/vlv3/74d734ca-0eab-4cd9-871f-bca01823d872/web/VN-vi-20241021-TRIFECTA-perspective_96a4f47f-aaa1-4b9a-b38b-919c90b66b80_large.jpg');
  backdrop-filter: brightness(0.5);background-repeat: no-repeat;background-size: cover;background-position: center;">
    <div class="wrapper wrapper-login">
        <!-- Đăng nhập tài khoản -->
        <div class="container container-login animated fadeIn"
            style="display: block;background: rgba(0, 0, 0, 0.7);color:white;border:none;">
            <h3 class="fs-1 fw-bolder">Đăng nhập</h3>
            <div class="login-form">
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="form-sub">
                        <div class="mb-3">
                            <input name="email" value="{{ old('email') }}" type="text" class="inputAuth"
                                placeholder="Email" required>
                            @error('email')
                                <small id="emailHelp2"
                                    class="form-text text-muted text-danger pt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3" style="position:relative;">
                            <input id="password" name="mat_khau" value="{{ old('mat_khau') }}" type="password"
                                class="inputAuth inputPasLogin" placeholder="Password" style="padding-right: 40px;"
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
                            @error('mat_khau')
                                <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-1">
                            @if (session()->has('error'))
                                <small id="emailHelp2"
                                    class="form-text text-muted text-danger">{{ session()->get('error') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="form-action pt-2">
                        <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                    </div>
                </form>
                <a href="#" class="mr">
                    Đăng ký
                </a>

                <div class="form-action pt-2">
                    <a href="#" style="color: white;">HOẶC</a>
                </div>
                <div class="form-action pt-3">
                    <a href="#" class="btn w-100"
                        style="width:100%;border: 1px solid #dadce0;color: white;height:40px;display: flex;align-items: center;padding-left: 20px;border-radius:5px;">
                        <svg style="width:20px;margin-right: 10px;" version="1.1" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 48 48" class="LgbsSe-Bz112c">
                            <g>
                                <path fill="#EA4335"
                                    d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z">
                                </path>
                                <path fill="#4285F4"
                                    d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z">
                                </path>
                                <path fill="#FBBC05"
                                    d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z">
                                </path>
                                <path fill="#34A853"
                                    d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z">
                                </path>
                                <path fill="none" d="M0 0h48v48H0z"></path>
                            </g>
                        </svg>
                        <span>Đăng nhập bằng google</span>
                    </a>
                </div>
                <div class="form-action pt-3">
                    <a href="#" class="btn w-100"
                        style="width:100%;border: 1px solid #dadce0;color: white;height:40px;display: flex;align-items: center;padding-left: 20px;border-radius:5px;">
                        <img width="20px" style="margin-right: 20px;"
                            src="https://cdn-icons-png.flaticon.com/512/3128/3128304.png" alt="">
                        <span>Đăng nhập bằng facebook</span>
                    </a>
                </div>
                <!-- <div class="login-account">
          <span class="msg">Bạn chưa có tài khoản ?</span>
          <a href="#" id="show-signup" class="link">Đăng ký</a>
        </div> -->
            </div>
        </div>
        <!-- Đăng ký tài khoản -->
        <div class="container container-signup animated fadeIn"
            style="display: none;background: rgba(0, 0, 0, 0.7);color:white;border:none;">
            <h3 class="fs-1 fw-bolder">Đăng ký</h3>
            <div class="login-form">
                <div class="form-sub">
                    <div class="mb-3">
                        <input id="fullname" name="fullname" type="text" class="inputAuth"
                            placeholder="Fullname" required="">
                    </div>
                    <div class="mb-3">
                        <input id="email" name="email" type="email" class="inputAuth" placeholder="Email"
                            required="">
                    </div>
                    <div class="mb-3" style="position:relative;">
                        <input id="passwordsignin" name="passwordsignin" type="password" class="inputAuth"
                            placeholder="Password" required="" style="padding-right: 40px;">
                        <div class="show-password">
                            <i class="icon-eye"></i>
                        </div>
                    </div>
                    <div class="mb-3" style="position:relative;">
                        <input id="confirmpassword" name="confirmpassword" type="password" class="inputAuth"
                            placeholder="Confirm password" required="" style="padding-right: 40px;">
                        <div class="show-password">
                            <i class="icon-eye"></i>
                        </div>
                    </div>
                </div>
                <div style="padding-left: 10px;">
                    <a href="#" id="show-signin" class="btn text-danger me-3"
                        style="border: 1px solid #959393;">Cancel</a>
                    <a href="#" class="btn btn-primary">Sign Up</a>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('kaiadmin-lite-1.2.0/assets/js/core/jquery-3.7.1.min.js') }}"></script>

    <script src="{{ asset('kaiadmin-lite-1.2.0/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('kaiadmin-lite-1.2.0/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('kaiadmin-lite-1.2.0/assets/js/kaiadmin.min.js') }}"></script>


</body>
<script>
    let iconShowPasLogin = document.querySelector('.show-passwordLogin');
    let inputpassLogin = document.querySelector('.inputPasLogin')
    let iconEyeLogin = document.querySelector('.iconEyeLogin')
    let iconEyeOffLogin = document.querySelector('.iconEyeOffLogin')
    iconShowPasLogin.addEventListener('click', function() {
        if (inputpassLogin.getAttribute("type") == 'password') {
            iconEyeLogin.style.display = 'none'
            iconEyeOffLogin.style.display = 'block'
        } else {
            iconEyeLogin.style.display = 'block'
            iconEyeOffLogin.style.display = 'none'
        }
    })
</script>

</html>
