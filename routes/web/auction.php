<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuctionController;

Route::prefix('auctions')->group(function() {
    Route::get('/', [AuctionController::class, 'index'])->name('index');
    Route::get('/{id}', [AuctionController::class, 'show'])->name('show');
});
