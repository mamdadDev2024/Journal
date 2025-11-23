<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Livewire\Login;
use Modules\Auth\Livewire\Register;
use Modules\Auth\Livewire\ForgotPassword;
use Modules\Auth\Livewire\ResetPassword;

Route::middleware(['guest'])->group(function () {
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');
    Route::get('forgot-password', ForgotPassword::class)->name('forgot-password');
});

Route::get('reset-password', ResetPassword::class)->name('reset-password');
Route::post('logout', \Modules\Auth\Http\Controllers\LogoutController::class)->name('logout');

