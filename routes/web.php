<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Rutas de Categorías
Route::resource('categorias', CategoriaController::class);
Route::get('categorias-export-excel', [CategoriaController::class, 'exportExcel'])->name('categorias.exportExcel');
Route::get('categorias-export-pdf', [CategoriaController::class, 'exportPdf'])->name('categorias.exportPdf');

// Rutas de Productos
Route::resource('productos', ProductoController::class);
Route::get('productos-export-excel', [ProductoController::class, 'exportExcel'])->name('productos.exportExcel');
Route::get('productos-export-pdf', [ProductoController::class, 'exportPdf'])->name('productos.exportPdf');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas de perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
