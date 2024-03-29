<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\AuctionController;
use App\Http\Controllers\Admin\FilialController;
use App\Http\Controllers\Admin\CategoryController;

Route::prefix('admin')->group(function() {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::prefix('auctions')->group(function() {
        Route::get('list', [AuctionController::class, 'list'])->name('list');
        Route::get('{id}/lots', [AuctionController::class, 'show'])->name('show');
    });
    Route::prefix('filials')->group(function() {
        Route::get('list', [FilialController::class, 'list'])->name('list');
    });
    Route::prefix('categories')->group(function() {
        Route::get('list', [CategoryController::class, 'list'])->name('list');
    });
});
