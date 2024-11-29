@extends('admin.index')

@section('content')
    <div class="page-inner">
        <div class="page-header mb-1">
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.roleAndUser.index') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Sửa vai trò của {{ $roleAndUser->user->ho_ten }}</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('admin.roleAndUser.update', $roleAndUser->nguoi_dung_id) }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Sửa vai trò cho tài khoản
                                <strong>{{ $roleAndUser->user->email }}</strong>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="disableinput">Tài khoản</label>
                                        <input type="text" class="form-control" value="{{ $roleAndUser->user->ho_ten }}"
                                            id="disableinput" placeholder="Enter Input" disabled="">
                                    </div>
                                    <div class="form-group">
                                        <label for="disableinput">Email tài khoản</label>
                                        <input type="text" class="form-control" value="{{ $roleAndUser->user->email }}"
                                            id="disableinput" placeholder="Enter Input" disabled="">
                                    </div>
                                    <div class="form-group">
                                        <label for="email2">Vai trò</label>
                                        <select class="form-select" name="vai_tro_id" id="exampleFormControlSelect1">
                                            @foreach ($role as $item)
                                                <option value="{{ $item->id }}"
                                                    @if ($item->id == $roleAndUser->vai_tro_id) selected @endif>
                                                    {{ $item->ten_vai_tro }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @if (session()->has('success'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session()->get('success') }}
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="reset" class="btn btn-danger">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
