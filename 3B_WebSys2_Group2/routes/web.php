<?php

use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RSMIController;
use App\Http\Controllers\StockCardController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [RSMIController::class, 'index'])->name('rsmi.index');


Route::resource('item', ItemController::class);

Route::resource('rsmi', RSMIController::class);
Route::get('rsmi/show/{month}/{year}', [RSMIController::class, 'show'])->name('rsmi.show');
Route::get('rsmi/edit/{month}/{year}', [RSMIController::class, 'edit'])->name('rsmi.edit');
Route::delete('rsmi/destroyMonth/{month}/{year}', [RSMIController::class, 'destroyMonth'])->name('rsmi.destroyMonth');

Route::resource('inventory', InventoryController::class);
Route::get('inventory/show/{month}/{year}', [InventoryController::class, 'show'])->name('inventory.show');
Route::get('inventory/edit/{month}/{year}', [InventoryController::class, 'edit'])->name('inventory.edit');

Route::resource('stockcard', StockCardController::class);
Route::get('stockcard/show/{item}/{year}', [StockCardController::class, 'show'])->name('stockcard.show');
Route::get('stockcard/edit/{item}/{year}', [StockCardController::class, 'edit'])->name('stockcard.edit');
Route::PUT('stockcard/updateDesc/{item}/{year}', [StockCardController::class, 'updateDesc'])->name('stockcard.updateDesc');
Route::delete('stockcard/destroyYear/{item}/{year}', [StockCardController::class, 'destroyYear'])->name('stockcard.destroyYear');