<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DanhmucController;
use App\Http\Controllers\TruyenController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Auth;


// Route::get('/', function () {
//     return view('layout');
// });
Route::get('/', [IndexController::class, 'home'])->name('home');
Route::get('/danh-muc/{slug}', [IndexController::class, 'danhmuc']);
Route::get('/xem-truyen/{slug}', [IndexController::class, 'xemtruyen']);
Route::get('/xem-chapter/{slug}', [IndexController::class, 'xemchapter']);
Route::post('/tim-kiem', [IndexController::class, 'timkiem']);
Route::post('/timkiem_ajax', [IndexController::class, 'timkiem_ajax']);
// Route::get('/xem-truyen/tap/{slug}', [IndexController::class,'tap']); //phần của thuận



Auth::routes();

Route::get('login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'storeLogin'])->name('store_login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route::resource('/danhmuc', DanhmucController::class)->middleware("auth");
Route::middleware(['auth', 'auth_admin'])->group(function () {
    Route::resource('/danhmuc', DanhmucController::class);
    Route::resource('/truyen', TruyenController::class);
    Route::resource('/chapter', ChapterController::class);
});
