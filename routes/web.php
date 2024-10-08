<?php

use App\Http\Controllers\absenController;
use App\Http\Controllers\dapdarController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\karyawanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\skorController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

// bisa di akses secara publik tanpa apapun------------------------------------------------------------------
Route::get('/', [homeController::class, 'index'])->name('dashboard');



// halaman di akses ketika email sudah terverifikasi------------------------------------------------------------
Route::middleware(['auth', 'verified'])->group(function () {});

// -------  halaman di akses ketika login------------------------------------------------------------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('profile-home/{id}', [ProfileController::class, 'index']);
});


// -------  halaman untuk admin------------------------------------------------------------------------------------
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('admin-home', [homeController::class, 'homeAdmin']);
    Route::post('admin-home', [homeController::class, 'homeAdmin']);
    Route::post('admin-home-sortir', [homeController::class, 'sortir']);
    // user prosess
    Route::get('user', [userController::class, 'index']);
    Route::post('edituser/{id}', [userController::class, 'update']);
    Route::post('deleteuser/{id}', [userController::class, 'delete']);
    // dapdar prosess
    Route::get('DAP-DAR', [dapdarController::class, 'index']);

    // sangsi
    Route::post('skor', [skorController::class, 'sangsi']);
});

// -------  halaman untuk admin dan gudang------------------------------------------------------------------------
Route::group(['middleware' => ['role:gudang']], function () {});

// -------  halaman untuk admin dan akuntan------------------------------------------------------------------------
Route::group(['middleware' => ['role:akuntan']], function () {});

// -------  halaman untuk admin dan karyawan------------------------------------------------------------------------
Route::group(['middleware' => ['role:karyawan']], function () {
    Route::get('karyawan-home', [karyawanController::class, 'index']);
});

// -------  halaman untuk admin dan sales--------------------------------------------------------------------------
Route::group(['middleware' => ['role:sales']], function () {});

// -------  halaman untuk admin dan sales------------------------------------------------------------------------
Route::group(['middleware' => ['role:admin,sales,karyawan,akuntan,gudang']], function () {
    // dapdar
    Route::post('inputdapdar', [dapdarController::class, 'create']);
    Route::post('updatedapdar/{id}', [dapdarController::class, 'update']);
    Route::delete('deletedap/{id}', [dapdarController::class, 'delete']);

    // absen
    Route::post('absensi', [absenController::class, 'create']);
    Route::delete('absensi/{id}', [absenController::class, 'destroy']);
});



require __DIR__ . '/auth.php';
