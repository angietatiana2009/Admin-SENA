<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreasController;
// Importa el controlador que atiende las peticiones API de centros.
use App\Http\Controllers\TrainingCentersController;
use App\Http\Controllers\ApprenticesController;
use App\Http\Controllers\ComputersController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\TeachersController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('areas', [AreasController::class, 'index'])->name('api.v1.areas.index');
Route::post('areas', [AreasController::class, 'store'])->name('api.v1.areas.store');
Route::get('areas/{area}', [AreasController::class, 'show'])->name('api.v1.areas.show');
Route::put('areas/{area}', [AreasController::class, 'update'])->name('api.v1.areas.update');
Route::delete('areas/{area}', [AreasController::class, 'destroy'])->name('api.v1.areas.destroy');

Route::get('training-centers', [TrainingCentersController::class, 'index'])->name('api.v1.training-centers.index');
Route::post('training-centers', [TrainingCentersController::class, 'store'])->name('api.v1.training-centers.store');
Route::get('training-centers/{trainingCenter}', [TrainingCentersController::class, 'show'])->name('api.v1.training-centers.show');
Route::put('training-centers/{trainingCenter}', [TrainingCentersController::class, 'update'])->name('api.v1.training-centers.update');
Route::delete('training-centers/{trainingCenter}', [TrainingCentersController::class, 'destroy'])->name('api.v1.training-centers.destroy');

Route::get('computers', [ComputersController::class, 'index'])->name('api.v1.computers.index');
Route::post('computers', [ComputersController::class, 'store'])->name('api.v1.computers.store');
Route::get('computers/{computer}', [ComputersController::class, 'show'])->name('api.v1.computers.show');
Route::put('computers/{computer}', [ComputersController::class, 'update'])->name('api.v1.computers.update');
Route::delete('computers/{computer}', [ComputersController::class, 'destroy'])->name('api.v1.computers.destroy');

Route::get('teachers', [TeachersController::class, 'index'])->name('api.v1.teachers.index');
Route::post('teachers', [TeachersController::class, 'store'])->name('api.v1.teachers.store');
Route::get('teachers/{teacher}', [TeachersController::class, 'show'])->name('api.v1.teachers.show');
Route::put('teachers/{teacher}', [TeachersController::class, 'update'])->name('api.v1.teachers.update');
Route::delete('teachers/{teacher}', [TeachersController::class, 'destroy'])->name('api.v1.teachers.destroy');

Route::get('courses', [CoursesController::class, 'index'])->name('api.v1.courses.index');
Route::post('courses', [CoursesController::class, 'store'])->name('api.v1.courses.store');
Route::get('courses/{course}', [CoursesController::class, 'show'])->name('api.v1.courses.show');
Route::put('courses/{course}', [CoursesController::class, 'update'])->name('api.v1.courses.update');
Route::delete('courses/{course}', [CoursesController::class, 'destroy'])->name('api.v1.courses.destroy');

Route::get('apprentices', [ApprenticesController::class, 'index'])->name('api.v1.apprentices.index');
Route::post('apprentices', [ApprenticesController::class, 'store'])->name('api.v1.apprentices.store');
Route::get('apprentices/{apprentice}', [ApprenticesController::class, 'show'])->name('api.v1.apprentices.show');
Route::put('apprentices/{apprentice}', [ApprenticesController::class, 'update'])->name('api.v1.apprentices.update');
Route::delete('apprentices/{apprentice}', [ApprenticesController::class, 'destroy'])->name('api.v1.apprentices.destroy');
