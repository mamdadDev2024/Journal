<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;

Route::prefix('user')->as('user.')->middleware('auth')->group(function () {
    Route::get('' , \Modules\User\Livewire\Profile::class)->name('profile');
    Route::get('contact' , \Modules\User\Livewire\Contact::class)->name('contact');
});
