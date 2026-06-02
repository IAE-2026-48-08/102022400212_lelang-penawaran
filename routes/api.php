<?php

use App\Http\Controllers\BidController;
use Illuminate\Support\Facades\Route;

Route::middleware(['iae.auth'])->prefix('v1')->group(function () {
    Route::get('/bids', [BidController::class, 'index']);
    Route::get('/bids/{id}', [BidController::class, 'show']);
    Route::post('/bids', [BidController::class, 'store']);
});