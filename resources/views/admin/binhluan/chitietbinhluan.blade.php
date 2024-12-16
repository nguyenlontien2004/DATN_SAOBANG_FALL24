@extends('admin.index')

@section('title')
{{ 'Quản lý đáng giá phim' }}
@endsection
@section('content')
<style>
    .btn-custom {
        border: none;
        background-color: transparent;
    }
</style>
<div class="row page-inner">
    <div class="col-md-12">
        <div class="content">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Danh sách bình luận phim: <span
                            class="text-danger">{{ $phim->ten_phim }}</span></h4>
                </div>
            </div>
            <div class="row mr-4">
                <div class="col-xl-12">
                    <div class="row">
                        <!-- Poster -->
                        <div class="col-md-2">
                            <div class="me-3">
                                <!-- Hình ảnh của video -->
                                <img alt="Video Thumbnail" class="img-fluid rounded film-image"
                                    src="{{ asset('storage/' . $phim->anh_phim) }}"
                                    style="cursor: pointer; width:100%; height: auto;">
                            </div>
                        </div>
                        <!-- Movie Details -->
                        <div class="col-md-8">
                            <p class="mb-0">
                                <strong>Thể loại:</strong>
                                @foreach ($phim->theloaiphims as $item)
                                    {{ $item->ten_the_loai }}
                                @endforeach
                            </p>
                            <p class="mb-0">
                                <strong>Diễn viên chính:</strong>
                                @foreach ($phim->dienViens as $dienVien)
                                    <a style="text-decoration: none;">{{ $dienVien->ten_dien_vien }}</a>
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </p>
                            <p class="mb-0">
                                <strong>Đạo diễn chính:</strong>
                                @foreach ($phim->daoDiens as $daoDien)
                                    <a style="text-decoration: none;">{{ $daoDien->ten_dao_dien }}</a>
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </p>
                            <p class="mb-0">
                                <strong>Mô tả:</strong>
                            </p>
                            {!! $phim->mo_ta !!}
                            <p></p>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-start">

                            </div>
                        </div>
                    </div>
                    <div>
                        <h2>Bình luận góp ý khách hàng</h2>
                    </div>
                    <div class="row">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @foreach ($phim->binhLuans as $item)
                            <div class="list-group-item mt-2 ms-3" style="border-bottom: 1px solid #dadada;">
                                <div class="d-flex w-100 mb-2 align-items-center">
                                    <h5 class="mb-1">
                                        <img width="35px" style="border-radius: 50%;"
                                            src="{{ asset('storage/' . $item->NguoiDung->anh_dai_dien) }}" alt="">
                                        <strong>{{ $item->NguoiDung->ho_ten ?? 'Người dùng ẩn danh' }}</strong>
                                    </h5>
                                    <small class="ms-2">{{ $item->created_at->locale('vi')->diffForHumans() }}</small>
                                    <form action="{{ route('admin.binhluan.xoabinhluan', $item->id) }}" method="post"
                                        class="ms-3"
                                        onsubmit="return confirm('Bạn có muốn xóa nội dung bình luận này không');">
                                        @csrf
                                        <button type="submit" class="btn-custom text-danger">Xoá đánh giá</button>
                                    </form>
                                </div>
                                <p class="mb-1">{!! $item->noi_dung !!}</p>

                                <div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- start row -->
        </div> <!-- content -->
    </div>
</div>
@endsection