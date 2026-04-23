<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController; // Saya tambahkan ini agar tidak error
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Product Page
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    
    // --- INI ADALAH KODE UNTUK LANGKAH 3B (ROUTE EXPORT) ---
    // Route ini sudah dilengkapi dengan middleware 'can:export-product'
    Route::get('/product/export', [ProductController::class, 'export'])
        ->name('product.export')
        ->middleware('can:export-product');
    // -------------------------------------------------------

    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
});

require __DIR__.'/auth.php';