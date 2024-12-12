@extends('layout.user')

@section('content')
<style>
    .header-tintuc {
        align-items: center;
        display: flex;
        flex-direction: row;
        flex-grow: 1;
        min-height: 3.75rem;
        padding-bottom: .5rem;
        padding-top: .5rem;
        background-color: #edf2f9 !important;
        border-radius: calc(.5rem - 1px) calc(.5rem - 1px) 0 0;
    }

    .tix-bg {
        background-image: url('https://cdn.moveek.com/build/images/tix-banner.ed8b6071.png');
        background-position: 50% 50%;
        background-size: cover;
        background-color: #12263f !important;
    }
</style>
<div class="tix-bg">
    <div class="container pt-4 pb-4">
    <div class="text-center">
                <h1 class="mb-3 text-white" style="font-size: 1.625rem;">
                    @if ($tendanhmuc !== null)
                    {{ $tendanhmuc->ten_danh_muc }}
                     @else
                     Tin tức mới
                    @endif
                </h1>   
            </div>
    </div>
</div>
<div class="container mt-5" style="max-width: 80rem;margin: 0 auto;">
    <div class="row">
        <div class="col-md-8" style="box-shadow: 0 .75rem 1.5rem rgba(18, 38, 63, .03);">
            <div class="bg-b  p-2 mb-3 header-tintuc">
                <span class="ml-2"> Mới nhất</span>
            </div>
            @foreach ($baiviet as $item)

                <div class="d-flex bg-white ms-2 p-1 rounded pb-3 pt-3"
                    style="border-bottom: 1px solid #e3ebf6 !important;">
                    <img alt="Hình ảnh minh họa" src="{{ asset('storage/' . $item->hinh_anh) }}" class="rounded me-3"
                        style="max-width: 180px; height: auto" />
                    <div>
                        <a href="{{ route('tintuc.show', $item->id) }}" class="fw-bold" style="text-decoration: none;">
                            {{ $item->tom_tat }}
                        </a>
                        <div class="flex align-items-center">
                            <span style="font-size: .8125rem;color: #95aac9 !important;color: #e63757 !important;"
                                class="flex text-danger align-items-center mr-2"><svg class="mr-1"
                                    xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-eye">
                                    <path
                                        d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>{{ $item->luot_xem . " lượt xem" }}</span>
                            <p style="font-size: .8125rem;color: #95aac9 !important;font-weight: 500;">
                                {{ $item->created_at->locale('vi')->diffForHumans() }}
                            </p>
                        </div>
                        <p class="text-secondary">
                            {!! $item->tom_tat !!}
                        </p>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="col-md-4" style="box-shadow: 0 .75rem 1.5rem rgba(18, 38, 63, .03);">
            <div class="bg-b  p-2 mb-3 header-tintuc">
                <span class="ml-2">Chuyên mục</span>
            </div>
            @foreach ($danhmuc as $item)
                <div class="bg-white p-3" style="border-bottom: 1px solid #e3ebf6 !important;">
                    <a class="fw-bold" href="{{ asset('thanh-vien/tin-tuc?danh-muc=' . $item->id) }}"
                        style="color: inherit;text-decoration: none;font-size: .9375rem;">{{ $item->ten_danh_muc }}</a>
                </div>
            @endforeach

        </div>
    </div>

</div>
@endsection