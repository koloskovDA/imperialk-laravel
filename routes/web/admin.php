<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\AuctionController;

Route::prefix('admin')->group(function() {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::prefix('auctions')->group(function() {
        Route::get('list', [AuctionController::class, 'list'])->name('list');
    });
});
