<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AnhBannerQuangCaoController;
use App\Http\Controllers\BaiVietTinTucController;
use App\Http\Controllers\BannerQuangCaoController;
use App\Http\Controllers\DanhMucBaiVietTinTucController;
use App\Http\Controllers\MaGiamGiaController;
use App\Models\AnhBannerQuangCao;
use App\Models\BaiVietTinTuc;
use App\Models\BannerQuangCao;
use App\Models\DanhMucBaiVietTinTuc;
use App\Http\Controllers\DoAnController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard']);
    Route::resource('bai-viet-tin-tuc', BaiVietTinTucController::class);
    Route::post('admin/bai-viet-tin-tuc/{baiVietTinTuc}/restore', [BaiVietTinTucController::class, 'restore'])->name('bai-viet-tin-tuc.restore');
    Route::delete('admin/bai-viet-tin-tuc/{baiVietTinTuc}/force-delete', [BaiVietTinTucController::class, 'forceDelete'])->name('bai-viet-tin-tuc.forDelete');
    
    Route::resource('danh-muc-bai-viet-tin-tuc', DanhMucBaiVietTinTucController::class);
    Route::post('admin/danh-muc-bai-viet-tin-tuc/{id}/restore', [DanhMucBaiVietTinTucController::class, 'restore'])->name('danh-muc-bai-viet-tin-tuc.restore');
    Route::delete('admin/danh-muc-bai-viet-tin-tuc/{id}/force-delete', [DanhMucBaiVietTinTucController::class, 'forceDelete'])->name('danh-muc-bai-viet-tin-tuc.forDelete');
    
    Route::resource('banner-quang-cao', BannerQuangCaoController::class);
    Route::post('admin/banner-quang-cao/{id}/restore', [BannerQuangCaoController::class, 'restore'])->name('banner-quang-cao.restore');
    Route::delete('admin/banner-quang-cao/{id}/force-delete', [BannerQuangCaoController::class, 'forceDelete'])->name('banner-quang-cao.forDelete');
    
    Route::resource('anh-banner-quang-cao', AnhBannerQuangCaoController::class);
    Route::post('admin/anh-banner-quang-cao/{id}/restore', [AnhBannerQuangCaoController::class, 'restore'])->name('anh-banner-quang-cao.restore');
    Route::delete('admin/anh-banner-quang-cao/{id}/force-delete', [AnhBannerQuangCaoController::class, 'forceDelete'])->name('anh-banner-quang-cao.forDelete');
    
    Route::resource('ma_giam_gia', MaGiamGiaController::class);
    Route::post('admin/ma_giam_gia/{id}/restore', [MaGiamGiaController::class, 'restore'])->name('ma_giam_gia.restore');
    Route::delete('admin/ma_giam_gia/{id}/force-delete', [MaGiamGiaController::class, 'forceDelete'])->name('ma_giam_gia.forceDelete');
  
              Route::get('/', [DoAnController::class, 'index'])->name('index');
            Route::get('/create', [DoAnController::class, 'create'])->name('create');
            Route::post('/store', [DoAnController::class, 'store'])->name('store');
            Route::get('/show/{id}', [DoAnController::class, 'show'])->name('show');
            Route::get('{id}/edit', [DoAnController::class, 'edit'])->name('edit');
            Route::put('{id}/update', [DoAnController::class, 'update'])->name('update');
            Route::delete('{id}/destroy', [DoAnController::class, 'destroy'])->name('destroy');
});

