<?php

use Illuminate\Support\Facades\Route;
use Modules\Tip\Livewire\TipEdit;
use Modules\Tip\Livewire\TipManage;
use Modules\Tip\Livewire\TipShow;

Route::as('tip.')->prefix('tip')->group(function () {
    Route::get('s/{Tip}', TipShow::class)->name('show');
    Route::get('e/{Tip}', TipEdit::class)->name('edit');
    Route::get('m/{Tip}', TipManage::class)->name('manage');
    Route::get('' , \Modules\Activity\Livewire\ActivityIndex::class)->name('index');
});
