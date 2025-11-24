<?php

use Illuminate\Support\Facades\Route;
use Modules\Core\Http\Controllers\RecommendDeleteController;
use Modules\Core\Livewire\Recommend;

Route::as('core.')->group(function () {
    Route::get('recommend' , Recommend::class)->name('recommend');
    Route::delete('recommend' , RecommendDeleteController::class)->name('recommend.delete');
    Route::get('search' , \Modules\Core\Livewire\Search::class)->name('search');
    Route::get('download' , \Modules\Core\Http\Controllers\DownloadController::class)->name('download');
    Route::get('contact' , \Modules\Core\Livewire\ContactCreate::class)->name('contact');

});
