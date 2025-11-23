<?php

use Illuminate\Support\Facades\Route;
use Modules\Tip\Http\Controllers\TipController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('tips', TipController::class)->names('tip');
});
