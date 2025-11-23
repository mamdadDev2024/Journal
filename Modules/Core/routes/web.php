<?php

use Illuminate\Support\Facades\Route;
use Modules\Core\Http\Controllers\CoreController;

Route::as('core.')->group(function () {
    Route::get('search' , \Modules\Core\Livewire\Search::class)->name('search');
    Route::get('download' , \Modules\Core\Http\Controllers\DownloadController::class)->name('download');
});
