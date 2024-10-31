<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;

use App\Http\Controllers\AnhBannerQuangCaoController;
use App\Http\Controllers\BaiVietTinTucController;
use App\Http\Controllers\BannerQuangCaoController;
use App\Http\Controllers\DanhMucBaiVietTinTucController;
use App\Http\Controllers\MaGiamGiaController;
use App\Http\Controllers\DoAnController;
use App\Http\Controllers\PhongChieuController;
use App\Http\Controllers\GheNgoiController;
use App\Http\Controllers\NguoiDungController;
use App\Http\Controllers\VaiTroController;
use App\Http\Controllers\VaiTroVaNguoiDungController;
use App\Http\Controllers\VeController;


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
  return view('user.trangchu');
});

Route::prefix('admin')->group(function () {
    // route auth admin
    Route::get('/login',                                   [AuthController::class,'login']);
    Route::post('post/login',                              [AuthController::class,'postLogin'])->name('login');
    
    Route::get('/',                                        [DashboardController::class, 'dashboard']);

  // Bài viết tin tức
  Route::resource('bai-viet-tin-tuc', BaiVietTinTucController::class);
  Route::post('admin/bai-viet-tin-tuc/{baiVietTinTuc}/restore', [BaiVietTinTucController::class, 'restore'])->name('bai-viet-tin-tuc.restore');
  Route::delete('admin/bai-viet-tin-tuc/{baiVietTinTuc}/force-delete', [BaiVietTinTucController::class, 'forceDelete'])->name('bai-viet-tin-tuc.forDelete');

  // Danh mục bài viết tin tức
  Route::resource('danh-muc-bai-viet-tin-tuc', DanhMucBaiVietTinTucController::class);
  Route::post('admin/danh-muc-bai-viet-tin-tuc/{id}/restore', [DanhMucBaiVietTinTucController::class, 'restore'])->name('danh-muc-bai-viet-tin-tuc.restore');
  Route::delete('admin/danh-muc-bai-viet-tin-tuc/{id}/force-delete', [DanhMucBaiVietTinTucController::class, 'forceDelete'])->name('danh-muc-bai-viet-tin-tuc.forDelete');

  // Vị trí banner quảng cáo
  Route::resource('banner-quang-cao', BannerQuangCaoController::class);
  Route::post('admin/banner-quang-cao/{id}/restore', [BannerQuangCaoController::class, 'restore'])->name('banner-quang-cao.restore');
  Route::delete('admin/banner-quang-cao/{id}/force-delete', [BannerQuangCaoController::class, 'forceDelete'])->name('banner-quang-cao.forDelete');

  // Ảnh banner quảng cáo
  Route::resource('anh-banner-quang-cao', AnhBannerQuangCaoController::class);
  Route::post('admin/anh-banner-quang-cao/{id}/restore', [AnhBannerQuangCaoController::class, 'restore'])->name('anh-banner-quang-cao.restore');
  Route::delete('admin/anh-banner-quang-cao/{id}/force-delete', [AnhBannerQuangCaoController::class, 'forceDelete'])->name('anh-banner-quang-cao.forDelete');

  // Mã giảm giá
  Route::resource('ma_giam_gia', MaGiamGiaController::class);
  Route::post('admin/ma_giam_gia/{id}/restore', [MaGiamGiaController::class, 'restore'])->name('ma_giam_gia.restore');
  Route::delete('admin/ma_giam_gia/{id}/force-delete', [MaGiamGiaController::class, 'forceDelete'])->name('ma_giam_gia.forceDelete');

  // Người dùng
  Route::resource('nguoi-dung', NguoiDungController::class);
  Route::post('admin/nguoi-dung/{id}/restore', [NguoiDungController::class, 'restore'])->name('nguoi-dung.restore');
  Route::delete('admin/nguoi-dung/{id}/force-delete', [NguoiDungController::class, 'forceDelete'])->name('nguoi-dung.forceDelete');

  // Đồ ăn
  Route::get('/danh-sach-do-an', [DoAnController::class, 'index'])->name('do-an.index');
  Route::get('/do-an/create', [DoAnController::class, 'create'])->name('do-an.create');
  Route::post('/do-an/store', [DoAnController::class, 'store'])->name('do-an.store');
  Route::get('/do-an/show/{id}', [DoAnController::class, 'show'])->name('do-an.show');
  Route::get('/do-an/{id}/edit', [DoAnController::class, 'edit'])->name('do-an.edit');
  Route::put('/do-an/{id}/update', [DoAnController::class, 'update'])->name('do-an.update');
  Route::delete('/do-an/{id}/destroy', [DoAnController::class, 'destroy'])->name('do-an.destroy');

  //start route phòng chiếu 
  Route::get('danh-sach-phong-chieu',                    [PhongChieuController::class, 'index'])->name('admin.phongChieu');
  Route::get('them-phong-chieu',                         [PhongChieuController::class, 'create'])->name('admin.themphongChieu');
  Route::post('them-phong-chieu',                        [PhongChieuController::class, 'store'])->name('admin.storephongChieu');
  Route::get('sua-phong-chieu/{id}',                     [PhongChieuController::class, 'edit'])->name('admin.editphongChieu');
  Route::post('updata-phong-chieu/{id}',                 [PhongChieuController::class, 'update'])->name('admin.updataphongChieu');
  Route::get('softDelete-phong-chieu/{id}',              [PhongChieuController::class, 'delete'])->name('admin.softDeletehongChieu');
  Route::get('danh-sach-phong-chieu-an',                 [PhongChieuController::class, 'listSoftDelete'])->name('admin.listSoftDeletehongChieu');
  Route::get('restore-phong-chieu/{id}',                 [PhongChieuController::class, 'restore'])->name('admin.restorePhongchieu');
  Route::get('phong-chieu/quan-ly-ghe/{id}',             [PhongChieuController::class, 'quanLyGhecuaphong'])->name('admin.quanLyGhecuaphong');
  // route thêm ghế cho phòng chiếu
  Route::get('get/ghe/phong-chieu/{id}',                 [GheNgoiController::class, 'index'])->name('admin.showSeats');
  Route::post('post/them-ghe/phong-chieu/{id}',          [GheNgoiController::class, 'store'])->name('admin.storeGhe');
  Route::post('delete/ghe/phong-chieu/',                 [GheNgoiController::class, 'delete'])->name('admin.deleteGhengoi');
  Route::get('get/loai-ghe/phong-chieu/{id}/{type}',     [GheNgoiController::class, 'getTypeSeat'])->name('admin.getTypeSeat');
  Route::post('post/sua-ghe/phong-chieu/{id}',           [GheNgoiController::class, 'update'])->name('admin.update');

  //end route phòng chiếu

  //start route vai trò
  Route::get('danh-sach-vai-tro/',                       [VaiTroController::class, 'index'])->name('admin.role.index');
  Route::get('danh-sach-vai-tro-an/',                    [VaiTroController::class, 'listRoleSoft'])->name('admin.role.listRoleSoft');
  Route::get('them-vai-tro/',                            [VaiTroController::class, 'create'])->name('admin.role.create');
  Route::post('post/them-vai-tro/',                      [VaiTroController::class, 'store'])->name('admin.role.store');
  Route::get('sua-vai-tro/{id}',                         [VaiTroController::class, 'edit'])->name('admin.role.edit');
  Route::post('post/sua-vai-tro/{id}',                   [VaiTroController::class, 'update'])->name('admin.role.update');
  Route::get('restore/vai-tro/{id}',                     [VaiTroController::class, 'restore'])->name('admin.role.restore');
  Route::get('xoa-vai-tro/{id}',                         [VaiTroController::class, 'delete'])->name('admin.role.delete');

  // route người dùng và vai trò
  Route::get('danh-sach-vai-tro-nguoi-dung/',            [VaiTroVaNguoiDungController::class, 'index'])->name('admin.roleAndUser.index');
  Route::get('cap-nhat-vai-tro-nguoi-dung/{id}',         [VaiTroVaNguoiDungController::class, 'edit'])->name('admin.roleAndUser.edit');
  Route::post('post/cap-nhat-vai-tro-nguoi-dung/{id}',   [VaiTroVaNguoiDungController::class, 'update'])->name('admin.roleAndUser.update');
  // route vé 
  Route::get('danh-sach-ve/',                            [VeController::class, 'index'])->name('admin.ticket.index');
  Route::get('chi-tiet-ve/{id}',                         [VeController::class, 'detail'])->name('admin.ticket.detail');

  // Route::resources('phims');
  Route::resource('daoDien', App\Http\Controllers\DaoDienController::class);
  Route::resource('phim', App\Http\Controllers\PhimController::class);
  Route::resource('dienVien', App\Http\Controllers\DienVienController::class);

  Route::resource('theLoaiPhim', App\Http\Controllers\TheLoaiPhimController::class);
  Route::resource('rap', App\Http\Controllers\RapController::class);
  Route::resource('suatChieu', App\Http\Controllers\SuatChieuController::class);
});
