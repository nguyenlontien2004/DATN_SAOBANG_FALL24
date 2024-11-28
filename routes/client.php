<?php

use App\Http\Controllers\API\DatVeController;
use Illuminate\Support\Facades\Route;

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

Route::get('dat-ve/{id}/{date}', [DatVeController::class, 'datve']);
Route::get('thanh-toan/{id}/{date}', [DatVeController::class, 'thanhToan'])->middleware('auth');
Route::post('online-checkOut', [DatVeController::class, 'checkViOnline'])->middleware('auth')->name('checkViOnline');
Route::get('thong-tin-ve/{id}/{macodeve}', [DatVeController::class, 'thongtinve'])->middleware('auth')->name('thongtinve');
Route::get('luu-thong-tin-ve', [DatVeController::class, 'luuThongTinVeMua'])->middleware('auth')->name('luuThongTinVeMua');
Route::get('check-qrCode/{idVe}', [DatVeController::class, 'checkqrCode'])->name('checkQrcode');
Route::get('testMail', [DatVeController::class, 'testMail']);
