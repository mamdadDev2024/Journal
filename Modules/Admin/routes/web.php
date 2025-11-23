<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AdminController;
use Modules\User\Http\Controllers\UserController;

Route::middleware(['auth', 'role:admin|super-admin'])->as('admin.')->prefix('admin')->group(function () {
    Route::get('' , \Modules\Admin\Livewire\Settings::class )->name('settings');
    Route::get('users', \Modules\Admin\Livewire\UserIndex::class)->name('users');
    Route::get('contents' , \Modules\Admin\Livewire\ContentIndex::class)->name('contents');
    Route::get('contacts' , \Modules\Admin\Livewire\ContactIndex::class)->name('contacts');
    Route::get('comments' , \Modules\Admin\Livewire\CommentIndex::class)->name('comments');
});
