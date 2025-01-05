<?php

use App\Http\Controllers\ElementsConstitutifController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UnitesEnseignementController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\EtudiantController;


use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return Inertia::render('Home');
});

Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('unites_enseignement', UnitesEnseignementController::class)
    ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('elements_constitutifs', ElementsConstitutifController::class)
    ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('notes', NoteController::class)
    ->only(['index', 'create', 'store', 'edit', 'update','show', 'destroy'])
    ->middleware(['auth', 'verified']);
// Route::get('/notes/moyenne/{etudiantId}/{ueId}', [NoteController::class, 'showMoyenne'])->name('notes.moyenne');

Route::resource('etudiants', EtudiantController::class)
    ->only(['index', 'create', 'store', 'edit', 'update', 'show','destroy'])
    ->middleware(['auth', 'verified']);


require __DIR__.'/auth.php';

