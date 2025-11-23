<?php

use Illuminate\Support\Facades\Route;
use Modules\Activity\Http\Controllers\ActivityController;
use Modules\Activity\Http\Controllers\ActivityDeleteController;

Route::as('activity.')->prefix('activity')->group(function () {
    Route::get('s/{Activity}' , \Modules\Activity\Livewire\ActivityShow::class)->name('show');
    Route::get('create' , \Modules\Activity\Livewire\ActivityCreate::class)->name('create');
    Route::get('e/{Activity}' , \Modules\Activity\Livewire\ActivityEdit::class)->name('edit');
    Route::get('m/{Activity}' , \Modules\Activity\Livewire\ActivityManage::class)->name('manage');
    Route::delete('d/{Activity}', ActivityDeleteController::class)->name('delete');
    Route::get('/' , \Modules\Activity\Livewire\ActivityIndex::class)->name('index');

});
