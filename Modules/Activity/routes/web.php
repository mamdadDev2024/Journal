<?php

use Illuminate\Support\Facades\Route;
use Modules\Activity\Http\Controllers\ActivityController;
Route::as('activity.')->prefix('activity')->group(function () {
    Route::get('s/{Activity}' , \Modules\Activity\Livewire\ActivityShow::class)->name('show');
    Route::get('e/{Activity}' , \Modules\Activity\Livewire\ActivityEdit::class)->name('edit');
    Route::get('/' , \Modules\Activity\Livewire\ActivityIndex::class)->name('index');
    Route::get('m/{Activity}' , \Modules\Activity\Livewire\ActivityManage::class)->name('manage');
});
