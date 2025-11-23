<?php

use Illuminate\Support\Facades\Route;
use Modules\Magazine\Http\Controllers\MagazineController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('magazines', MagazineController::class)->names('magazine');
});
