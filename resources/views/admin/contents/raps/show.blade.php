@extends('admin.index')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Rạp | {{ $rap->ten_rap }}</h5>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row room">
                        @foreach ($phong_chieus as $room)
                            <div class="col-md-4 mb-3">
                                <h5>{{ $room->ten_phong_chieu }}</h5>
                                <div class="room-box" 
                                     style="border: 5px solid {{ $room->current_suat_chieus->isEmpty() ? 'red' : 'green' }}; padding: 10px; border-radius: 5px;">
                                    @if ($room->current_suat_chieus->isEmpty())
                                        <p>Không có suất chiếu hiện tại</p>
                                    @else
                                        <ul class="list-unstyled">
                                            @foreach ($room->current_suat_chieus as $suat)
                                                <li>
                                                    Phim: {{ $suat->phim->ten_phim }}<br>
                                                    Thời gian: {{ $suat->gio_bat_dau }} - {{ $suat->gio_ket_thuc }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- @extends('admin.index')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Rạp | {{ $rap->ten_rap }}</h5>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row room">
                        @foreach ($phong_chieus as $room)
                            <div class="col-md-4 mb-3">
                                <h5>{{ $room->ten_phong_chieu }}</h5>
                                <div class="room-box"
                                    style="border: 5px solid {{ $room->current_suat_chieus->isEmpty() ? 'red' : 'green' }}; padding: 10px; border-radius: 5px;">
                                    @if ($room->current_suat_chieus->isEmpty())
                                        <p>Không có suất chiếu hiện tại</p>
                                    @else
                                        <ul class="list-unstyled">
                                            @foreach ($room->current_suat_chieus as $suat)
                                                <li>
                                                    <strong>Phim:</strong> {{ $suat->phim->ten_phim }}<br>
                                                    <strong>Thời gian:</strong>
                                                    {{ \Carbon\Carbon::createFromFormat('H:i', $suat->gio_bat_dau)->format('H:i') }}
                                                    -
                                                    {{ \Carbon\Carbon::createFromFormat('H:i', $suat->gio_ket_thuc)->format('H:i') }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}
