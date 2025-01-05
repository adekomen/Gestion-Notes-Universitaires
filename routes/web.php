<?php

use App\Http\Controllers\ElementsConstitutifController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UnitesEnseignementController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\EtudiantController; 



use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/note', [NoteController::class, 'index'])->name('note');
Route::get('/note/create', [NoteController::class, 'create'])->name('notes.create');
Route::get('/notes/{note}edit', [NoteController::class, 'edit'])->name('notes.edit');
Route::put('/notes/{note}', [EtudiantController::class, 'update'])->name('notes.update');
Route::get('/notes/show', [NoteController::class, 'show'])->name('notes.show');
Route::post('/notes/store', [NoteController::class, 'store'])->name('notes.store');
Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');



Route::get('/etudiants', [EtudiantController::class, 'index'])->name('etudiants.index');
Route::get('/etudiants/create', [EtudiantController::class, 'create'])->name('etudiants.create');
Route::get('/etudiants/{etudiant}/edit', [EtudiantController::class, 'edit'])->name('etudiants.edit');
Route::put('/etudiants/{etudiant}', [EtudiantController::class, 'update'])->name('etudiants.update');
Route::get('/etudiants/{etudiant}', [EtudiantController::class, 'show'])->name('etudiants.show');
Route::post('/etudiants', [EtudiantController::class, 'store'])->name('etudiants.store');
Route::delete('/etudiants/{etudiant}', [EtudiantController::class, 'destroy'])->name('etudiants.destroy');

require __DIR__.'/auth.php';

