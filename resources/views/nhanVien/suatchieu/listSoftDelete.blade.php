@extends('nhanVien.index')

@section('content')
    <div class="card m-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="card-title">Danh sách suất chiếu đã xóa mềm</div>
            </div>
        </div>

        <div class="card-body">
            @if ($suatChieus->count())
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Phim</th>
                            <th scope="col">Phòng Chiếu</th>
                            <th scope="col">Suất Chiêu</th>
                            <th scope="col" class="text-center">Ngày xóa</th>
                            <th scope="col" class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suatChieus as $suatChieu)
                            <tr>
                                <td>{{ $suatChieu->id }}</td>
                                <td>{{ $suatChieu->phim->ten_phim }}</td>
                                <td>Phòng: {{ $suatChieu->phongChieu->ten_phong_chieu }},Rạp:
                                    {{ $suatChieu->phongChieu->rap->ten_rap ?? 'N/A' }}
                                <td><span
                                        class="text-info">{{ \Carbon\Carbon::parse($suatChieu->gio_bat_dau)->format('H:i') }}</span>
                                    -
                                    <span
                                        class="text-danger">{{ \Carbon\Carbon::parse($suatChieu->gio_ket_thuc)->format('H:i') }}</span><span
                                        class="px-2">/</span>
                                    {{ $suatChieu->ngay }}
                                </td>
                                 <td class="text-center">{{ $suatChieu->deleted_at }}</td>
                               <td class="text-center">
                                    <form action="{{ route('nhanvien.suatchieu.restore',$suatChieu->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-success btn-sm">Khôi phục</button>
                                    </form>

                                
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center">Không có dữ liệu xóa mềm.</p>
            @endif
        </div>
    </div>
@endsection
