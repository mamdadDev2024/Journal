<?php

use Illuminate\Support\Facades\Route;
use Modules\Tip\Http\Controllers\TipDeleteController;
use Modules\Tip\Livewire\TipCreate;
use Modules\Tip\Livewire\TipEdit;
use Modules\Tip\Livewire\TipManage;
use Modules\Tip\Livewire\TipShow;

Route::as('tip.')->prefix('tip')->group(function () {
    Route::get('' , \Modules\Activity\Livewire\ActivityIndex::class)->name('index');
    Route::get('s/{Tip}', TipShow::class)->name('show');
    Route::get('create', TipCreate::class)->name('create');
    Route::get('e/{Tip}', TipEdit::class)->name('edit');
    Route::get('m/{Tip}', TipManage::class)->name('manage');
    Route::delete('d/{Tip}', TipDeleteController::class)->name('delete');
});
