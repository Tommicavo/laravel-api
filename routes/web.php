<?php

use App\Http\Controllers\Guests\HomeController as GuestsHomeController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rotta HomeController per i Guests
Route::get('/', [GuestsHomeController::class, 'index'])->name('guests.home');

// Rotta HomeController per l'Admin
Route::get('/admin', [AdminHomeController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.home');


Route::prefix('/admin')->middleware(['auth', 'verified'])->name('admin.')->group(function () {
    // Rotte ProjectController
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index'); // projects list
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create'); // form creation project
    Route::get('/projects/trash', [ProjectController::class, 'trash'])->name('projects.trash'); // trash page
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show'); // project details
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit'); // form update project
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store'); // store project
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update'); // update project
    Route::patch('/projects/{project}', [ProjectController::class, 'reorder'])->name('projects.reorder'); // reorder project
    Route::patch('/projects/{project}/restore', [ProjectController::class, 'restore'])->name('projects.restore'); // restore project
    Route::patch('/projects/{project}/toggle', [ProjectController::class, 'toggle'])->name('projects.toggle'); // toggle status
    Route::delete('projects/drop', [ProjectController::class, 'dropAll'])->name('projects.dropAll'); // empty trash can
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy'); // move project into trash
    Route::delete('/projects/{project}/drop', [ProjectController::class, 'drop'])->name('projects.drop'); // delete project from db

    // Rotte TypeController
    Route::get('/types', [TypeController::class, 'index'])->name('types.index'); // types list
    Route::get('/types/create', [TypeController::class, 'create'])->name('types.create'); // form creation type
    Route::get('/types/{type}', [TypeController::class, 'show'])->name('types.show'); // type details
    Route::get('/types/{type}/edit', [TypeController::class, 'edit'])->name('types.edit'); // form update type
    Route::post('/types', [TypeController::class, 'store'])->name('types.store'); // store type
    Route::put('/types/{type}', [TypeController::class, 'update'])->name('types.update'); // update type
    Route::delete('/types/{type}', [TypeController::class, 'destroy'])->name('types.destroy'); // move type into trash

    // Rotte TechnologyController
    Route::get('/technologies', [TechnologyController::class, 'index'])->name('technologies.index'); // technologies list
    Route::get('/technologies/create', [TechnologyController::class, 'create'])->name('technologies.create'); // form creation technology
    Route::get('/technologies/{technology}', [TechnologyController::class, 'show'])->name('technologies.show'); // technology details
    Route::get('/technologies/{technology}/edit', [TechnologyController::class, 'edit'])->name('technologies.edit'); // form update technology
    Route::post('/technologies', [TechnologyController::class, 'store'])->name('technologies.store'); // store technology
    Route::put('/technologies/{technology}', [TechnologyController::class, 'update'])->name('technologies.update'); // update technology
    Route::delete('/technologies/{technology}', [TechnologyController::class, 'destroy'])->name('technologies.destroy'); // move technology into trash
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
