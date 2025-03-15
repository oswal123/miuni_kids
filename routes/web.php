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

Route::get('/ejercicio_nivel1', [ExerciseController::class, 'showExercise'])->name('ejercicio_nivel1')->middleware('auth');
Route::get('/ejercicio_nivel2', [ExerciseController::class, 'showExerciseNivel2'])->name('ejercicio_nivel2')->middleware('auth');
Route::get('/ejercicio_nivel3', [ExerciseController::class, 'showExerciseNivel3'])->name('ejercicio_nivel3')->middleware('auth');
Route::get('/ejercicio/{index}', [ExerciseController::class, 'showSingleExercise'])->name('show_exercise')->middleware('auth');
Route::post('/ejercicio/{index}/verificar', [ExerciseController::class, 'verifyExercise'])->name('verify_exercise')->middleware('auth');
Route::post('/reiniciar-nivel', [ExerciseController::class, 'reiniciarNivel'])->name('reiniciar_nivel')->middleware('auth');
Route::post('/reiniciar-nivel2', [ExerciseController::class, 'reiniciarNivel2'])->name('reiniciar_nivel2')->middleware('auth');
Route::post('/reiniciar-nivel3', [ExerciseController::class, 'reiniciarNivel3'])->name('reiniciar_nivel3')->middleware('auth');
