@php
    $menu = DB::table('danh_muc_tin_tucs')->select('id', 'ten_danh_muc')->orderBy('id')->get();
@endphp
<nav class="navbar navbar-expand-lg navbar-light border-top ">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav mx-auto menu">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('user.trangchu') }}">Trang
                        Chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('tin.tinmoi') }}">Tin Mới
                        Nhất</a>
                </li>
                @foreach ($menu as $mn)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/tin-loai', [$mn->id]) }}">{{ $mn->ten_danh_muc }}</a>
                    </li>
                @endforeach
                <li class="nav-item">
                    <a class="nav-link" href="#">Liên Hệ</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
