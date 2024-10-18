<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommunityLinkController; // Agregar el controlador de CommunityLink
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Reemplaza la ruta '/dashboard' con el controlador
Route::get('/dashboard', [CommunityLinkController::class, 'index'])
->middleware(['auth', 'verified'])
->name('dashboard');

//Añadir Link community-add-link
Route::post('/dashboard', [CommunityLinkController::class, 'store'])
    ->middleware(['auth', 'verified']);


Route::get('/mylinks', [CommunityLinkController::class, 'myLinks'])->name('myLinks')
    ->middleware(['auth', 'verified']);

// Se crea una ruta (/borrar) y llama al metodo show de comunitryLinkController en Http/Controller/CommunityLinkController
Route::get('/borrar', [CommunityLinkController::class, 'show']); 

Route::get('/contact', function () {
    return view('contact');
})->middleware(['auth', 'verified'])->name('contact');

Route::get('/analytics', function () {
    return view('analytics');
})->middleware(['auth', 'verified'])->name('analytics');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
