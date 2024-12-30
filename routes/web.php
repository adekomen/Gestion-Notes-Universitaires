<?php
use App\Http\Controllers\NoteController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::resource('note', NoteController::class)
//     ->only(['index', 'store', 'edit', 'update', 'destroy'])
//     ->middleware(['auth', 'verified']);
Route::get('/note', [NoteController::class, 'index'])->name('note');
Route::get('/note/create', [NoteController::class, 'create'])->name('notes.create');
Route::post('/note', [NoteController::class, 'store'])->name('notes.store');
require __DIR__.'/auth.php';
