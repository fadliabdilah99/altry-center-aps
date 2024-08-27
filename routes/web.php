<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// bisa di akses secara publik tanpa apapun------------------------------------------------------------------
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');



// halaman di akses ketika email sudah terverifikasi------------------------------------------------------------
Route::middleware(['auth', 'verified'])->group(function () {});

// -------  halaman di akses ketika login------------------------------------------------------------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// -------  halaman untuk admin dan gudang------------------------------------------------------------------------
Route::group(['middleware' => ['role:admin,gudang']], function () {});

// -------  halaman untuk admin dan akuntan------------------------------------------------------------------------
Route::group(['middleware' => ['role:admin,akuntan']], function () {});

// -------  halaman untuk admin dan karyawan------------------------------------------------------------------------
Route::group(['middleware' => ['role:admin,karyawan']], function () {});

// -------  halaman untuk admin dan sales------------------------------------------------------------------------
Route::group(['middleware' => ['role:admin,sales']], function () {});



require __DIR__ . '/auth.php';
