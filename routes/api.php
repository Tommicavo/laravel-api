<?php

use App\Http\Controllers\api\ProjectController;
use App\Http\Controllers\Api\TypeProjectsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// HomePage
Route::get('projects/', [ProjectController::class, 'index']);

// Project Detail
Route::get('projects/{project}', [ProjectController::class, 'show']);

// Projects by Type
Route::get('types/{type}/projects', [TypeProjectsController::class, 'index']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
