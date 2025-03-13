<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExerciseController;

Route::get('/', [AuthController::class, 'showIndex'])->name('index');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/ejercicio_index', [ExerciseController::class, 'showExercise'])->name('ejercicio_index')->middleware('auth');
Route::get('/ejercicio/{index}', [ExerciseController::class, 'showSingleExercise'])->name('show_exercise')->middleware('auth');
Route::post('/ejercicio/{index}', [ExerciseController::class, 'verifyExercise'])->name('verify_exercise')->middleware('auth');
