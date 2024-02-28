<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\IndexController;

Route::prefix('admin')->group(function() {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::resource('auctions', \App\Http\Controllers\Admin\AuctionController::class);

});
