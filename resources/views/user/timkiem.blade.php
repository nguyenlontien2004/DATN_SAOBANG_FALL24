@extends('layout.user')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <main class="container mx-auto px-4 py-8" style="max-width: 80rem;margin: 0 auto;">
    
        @if ($ketqua1->isNotEmpty() || $ketqua2->isNotEmpty())
            <section class="mt-12">
                <h2 class="text-2xl font-bold text-center text-gray-900 mb-8">
                    Kết quả tìm kiếm
                </h2>
                <div class="grid grid-cols-4 gap-4">
                    @foreach ($ketqua1 as $item)
                    @php
                            $idyoutube = (str_replace("https://www.youtube.com/watch?v=", "", $item->trailer));
                            $embedUrl = "https://www.youtube.com/embed/" . $idyoutube;
                           @endphp
                        <div class="rounded-lg">
                            <div class="film-card position-relative">
                                <!-- Hình ảnh của video -->
                                <img alt="Video Thumbnail" class="film-image rounded-lg mb-4"
                                    src="{{ asset('storage/'.$item->anh_phim) }} "
                                    onclick="playVideo('{{ $embedUrl }}')"
                                    style="cursor: pointer;filter: contrast(105%);height:400px;" />
                                <a href="{{ route('client.chitietvedat', $item->id) }}" class="hover-enlarge">
                                    <h3 class="text-lg font-bold film-title">
                                        {{ $item->ten_phim }}
                                    </h3>
                                </a>
                                <p class="film-genre">
                                    @foreach ($item->theLoaiPhims as $theLoaiPhim)
                                        {{ $theLoaiPhim->ten_the_loai }}@if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </p>
                                <!-- <p class="text-yellow-500">
                                    <i class="fas fa-star"></i> 6.3
                                </p> -->
                            </div>
                        </div>
                    @endforeach

                    {{-- Danh sách phim tìm kiếm theo thể loại --}}
                    @foreach ($ketqua2 as $item)
                        @foreach ($item->phims as $tenPhim)
                        @php
                            $idyoutube = (str_replace("https://www.youtube.com/watch?v=", "", $tenPhim->trailer));
                            $embedUrl = "https://www.youtube.com/embed/" . $idyoutube;
                           @endphp
                            <div class="rounded-lg">
                                <div class="film-card position-relative">
                                    <!-- Hình ảnh của video -->
                                    <img alt="Video Thumbnail" class="film-image rounded-lg mb-4"
                                        src="{{ asset('storage/'.$tenPhim->anh_phim) }}"
                                        onclick="playVideo('{{ $embedUrl }}')"
                                        style="cursor: pointer;filter: contrast(105%);height:400px;" />

                                    <a href="{{ route('client.chitietvedat', $item->id) }}" class="hover-enlarge">
                                        <h3 class="text-lg font-bold film-title">
                                            {{ $tenPhim->ten_phim }}
                                        </h3>
                                    </a>

                                    <p class="film-genre">
                                        {{ $item->ten_the_loai }}
                                    </p>

                                    <!-- <p class="text-yellow-500">
                                        <i class="fas fa-star"></i> 6.3
                                    </p> -->
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </section>
        @else
            <h2 class="text-2xl font-bold text-center text-gray-400 mb-8">
                <br>Kết quả tìm kiếm không phù hợp
            </h2>
        @endif
    </main>
@endsection