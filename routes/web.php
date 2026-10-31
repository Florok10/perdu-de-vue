<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\PlaceController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/objets');

Route::get('/objets', [ItemController::class, 'index'])->name('items.index');
Route::get('/objets/nouveau', [ItemController::class, 'create'])->name('items.create');
Route::post('/objets', [ItemController::class, 'store'])->name('items.store');
Route::get('/objets/{item}', [ItemController::class, 'show'])->whereNumber('item')->name('items.show');
Route::get('/objets/{item}/modifier', [ItemController::class, 'edit'])->whereNumber('item')->name('items.edit');
Route::put('/objets/{item}', [ItemController::class, 'update'])->whereNumber('item')->name('items.update');
Route::patch('/objets/{item}/restitution', [ItemController::class, 'return'])->whereNumber('item')->name('items.return');
Route::delete('/objets/{item}', [ItemController::class, 'destroy'])->whereNumber('item')->name('items.destroy');

Route::get('/lieux/{place}', [PlaceController::class, 'show'])->whereNumber('place')->name('places.show');

Route::view('/composants', 'styleguide')->name('styleguide');
