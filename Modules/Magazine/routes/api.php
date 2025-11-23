<?php

use Illuminate\Support\Facades\Route;
use Modules\Magazine\Http\Controllers\MagazineController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('magazines', MagazineController::class)->names('magazine');
});
