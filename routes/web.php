<?php

use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/', function () {
        return view('dashboard.index');
    })->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('bus', BusController::class);
    Route::resource('packages', PackageController::class);
    Route::resource('pemesanans', PemesananController::class);
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/pdf', [ReportController::class, 'exportPdf'])->name('reports.export.pdf');
});
