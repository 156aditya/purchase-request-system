<?php

use App\Http\Controllers\PurchaseRequestController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [PurchaseRequestController::class, 'dashboard'])
         ->name('dashboard');

    Route::resource('purchase-requests', PurchaseRequestController::class);

    Route::patch(
        '/purchase-requests/{purchaseRequest}/status',
        [PurchaseRequestController::class, 'updateStatus']
    )->name('purchase-requests.updateStatus');

    Route::get('/api/purchase-requests',
        [PurchaseRequestController::class, 'apiIndex'])
        ->name('api.purchase-requests.index');

    Route::get('/api/purchase-requests/{purchaseRequest}',
        [PurchaseRequestController::class, 'apiShow'])
        ->name('api.purchase-requests.show');

});

Auth::routes();