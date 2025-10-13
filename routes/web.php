<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.showLogin');
Route::post('/admin/login_submit', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', action: [AdminController::class, 'logout'])->name('admin.logout');

Route::get('/admin/forget_password', [AdminController::class, 'forget_password'])->name('admin.forget_password');
Route::post('/admin/password_submit', [AdminController::class, 'password_submit'])->name('admin.password_submit');
Route::get('/admin/reset_password/{token}/{email}', [AdminController::class, 'reset_password']);
Route::post('/admin/reset_password_submit', [AdminController::class, 'reset_password_submit'])->name('admin.reset_password_submit');
