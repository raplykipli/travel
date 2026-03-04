<?php

use App\Http\Controllers\FormUserController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;

/*
|------------------------------
| HALAMAN PELANGGAN (HOME)
|------------------------------
*/
Route::get('/', function () {
    return view('home');
});


/*
|------------------------------
| LOGIN ADMIN
|------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|------------------------------
| FORM PEMESANAN PELANGGAN
|------------------------------
*/
Route::get('/form-pemesanan', [FormUserController::class, 'index'])->name('form-user.index');
Route::post('/form-pemesanan', [FormUserController::class, 'store'])->name('form-user.store');

Route::get('/form-pemesanan/{pemesanan}/payment', [FormUserController::class, 'payment'])->name('form-user.payment');
Route::post('/form-pemesanan/{pemesanan}/payment', [FormUserController::class, 'processPayment'])->name('form-user.process-payment');

Route::get('/form-pemesanan/thank-you', function () {
    return view('form_user.thank-you');
})->name('form-user.thank-you');

// API endpoint untuk mendapatkan kursi terpakai
Route::get('/api/kursi-terpakai', [PemesananController::class, 'getKursiTerpakai'])->name('api.kursi-terpakai');


/*
|------------------------------
| AREA ADMIN (WAJIB LOGIN)
|------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('bus', BusController::class)->parameters(['bus' => 'bus']);
    Route::resource('packages', PackageController::class);
    Route::resource('pemesanans', PemesananController::class);

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/pdf', [ReportController::class, 'exportPdf'])->name('reports.export.pdf');
});
