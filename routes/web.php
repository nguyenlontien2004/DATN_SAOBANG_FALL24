<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\PhongChieuController;
use App\Http\Controllers\GheNgoiController;
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
    return view('welcome');
});
Route::prefix('admin')->group(function () {
    // route auth admin
    Route::get('/login',                                   [AuthController::class,'login']);
    Route::post('post/login',                              [AuthController::class,'postLogin'])->name('login');
    
    Route::get('/',                                        [DashboardController::class, 'dashboard']);
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
    
});