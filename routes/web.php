<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\PhongChieuController;
use App\Http\Controllers\GheNgoiController;

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
    //start route phòng chiếu 
    Route::get('danh-sach-phong-chieu',               [PhongChieuController::class, 'index'])->name('admin.phongChieu');
    Route::get('them-phong-chieu',                    [PhongChieuController::class, 'create'])->name('admin.themphongChieu');
    Route::post('them-phong-chieu',                   [PhongChieuController::class, 'store'])->name('admin.storephongChieu');
    Route::get('sua-phong-chieu/{id}',                [PhongChieuController::class, 'edit'])->name('admin.editphongChieu');
    Route::post('updata-phong-chieu/{id}',            [PhongChieuController::class, 'update'])->name('admin.updataphongChieu');
    Route::get('softDelete-phong-chieu/{id}',         [PhongChieuController::class, 'delete'])->name('admin.softDeletehongChieu');
    Route::get('danh-sach-phong-chieu-an',            [PhongChieuController::class, 'listSoftDelete'])->name('admin.listSoftDeletehongChieu');
    Route::get('phong-chieu/quan-ly-ghe/{id}',        [PhongChieuController::class, 'quanLyGhecuaphong'])->name('admin.quanLyGhecuaphong');
    // route thêm ghế cho phòng chiếu
    Route::get('get/ghe/phong-chieu/{id}',            [GheNgoiController::class, 'index'])->name('admin.showSeats');
    Route::post('post/them-ghe/phong-chieu/{id}',     [GheNgoiController::class, 'store'])->name('admin.storeGhe');
    Route::post('delete/ghe/phong-chieu/',            [GheNgoiController::class, 'delete'])->name('admin.deleteGhengoi');
    Route::get('get/loai-ghe/phong-chieu/{id}/{type}',[GheNgoiController::class, 'getTypeSeat'])->name('admin.getTypeSeat');
    Route::post('post/sua-ghe/phong-chieu/{id}',      [GheNgoiController::class, 'update'])->name('admin.update');

    //end route phòng chiếu
});