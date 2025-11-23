<?php

use Illuminate\Support\Facades\Route;
use Modules\Magazine\Http\Controllers\MagazineController;
use Modules\Magazine\Http\Controllers\MagazineDeleteController;

Route::as('magazine.')->prefix('magazine')->group(function () {
    Route::get('' , \Modules\Magazine\Livewire\MagazineIndex::class)->name('index');
    Route::get('s/{Magazine}', \Modules\Magazine\Livewire\MagazineShow::class)->name('show');
    Route::get('create', \Modules\Magazine\Livewire\MagazineCreate::class)->name('create');
    Route::get('e/{Magazine}', \Modules\Magazine\Livewire\MagazineEdit::class)->name('edit');
    Route::get('m/{Magazine}', \Modules\Magazine\Livewire\MagazineManage::class)->name('manage');
    Route::delete('d/{Magazine}', MagazineDeleteController::class)->name('delete');
});
