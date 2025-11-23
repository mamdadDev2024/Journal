<?php

use Illuminate\Support\Facades\Route;
use Modules\Tip\Http\Controllers\TipController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('tips', TipController::class)->names('tip');
});
