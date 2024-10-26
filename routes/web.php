<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
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
Route::prefix('admin')->as('admin.')->group(function () {
    Route::prefix('doans')
        ->as('doans.')
        ->group(function () {
            Route::get('/', [DoAnController::class, 'index'])->name('index');
            Route::get('/create', [DoAnController::class, 'create'])->name('create');
            Route::post('/store', [DoAnController::class, 'store'])->name('store');
            Route::get('/show/{id}', [DoAnController::class, 'show'])->name('show');
            Route::get('{id}/edit', [DoAnController::class, 'edit'])->name('edit');
            Route::put('{id}/update', [DoAnController::class, 'update'])->name('update');
            Route::delete('{id}/destroy', [DoAnController::class, 'destroy'])->name('destroy');
        });
});
