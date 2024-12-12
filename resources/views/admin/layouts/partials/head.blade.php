<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Website đặt vé xem phim Sao Băng</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('kaiadmin-lite-1.2.0/assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ asset('kaiadmin-lite-1.2.0/assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ["{{ asset('kaiadmin-lite-1.2.0/assets/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('kaiadmin-lite-1.2.0/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('kaiadmin-lite-1.2.0/assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('kaiadmin-lite-1.2.0/assets/css/kaiadmin.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('kaiadmin-lite-1.2.0/assets/css/demo.css') }}" />

    @if (Route::currentRouteName() === 'admin.quanLyGhecuaphong')
        <link rel="stylesheet" href="{{ asset('kaiadmin-lite-1.2.0/assets/css/seatSelectPage.css') }}" />
    @endif
    <link rel="stylesheet" href="{{ asset('kaiadmin-lite-1.2.0/assets/css/seatSelectPage.css') }}" />

    <!-- Tải jQuery trước -->
    <script src="{{ asset('kaiadmin-lite-1.2.0/assets/js/core/jquery-3.7.1.min.js') }}"></script>

    <!-- Sau đó mới tải Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
</head>
