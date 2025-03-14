<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Exercise;

class ExerciseController extends Controller
{
    public function showExercise()
    {
        // Obtener ejercicios completados del usuario actual
        $completedExercises = Exercise::where('user_id', Auth::id())->get();
        $completedExercisesArray = $completedExercises->map(function ($exercise) {
            return [
                'values' => json_decode($exercise->values, true),
                'result' => $exercise->result,
                'completed' => true,
            ];
        })->toArray();

        // Generar nuevos ejercicios si el total es menor que 8
        $totalExercises = count($completedExercisesArray);
        $newExercises = [];
        for ($i = $totalExercises; $i < 8; $i++) {
            $values = [];
            for ($j = 0; $j < 4; $j++) {
                $values[] = rand(1000, 9999); // Generar números de 4 dígitos
            }
            $newExercises[] = $values;
        }

        // Combinar ejercicios completados con nuevos ejercicios
        $exercises = array_merge($completedExercisesArray, $newExercises);

        session(['exercises' => $exercises]);
        return view('ejercicio_index', ['exercises' => $exercises]);
    }

    public function showSingleExercise($index)
    {
        $exercises = session('exercises');
        if (!$exercises || !isset($exercises[$index])) {
            return redirect()->route('ejercicio_index');
        }

        $exercise = $exercises[$index];
        return view('show_exercise', ['exercise' => $exercise, 'index' => $index]);
    }

    public function verifyExercise(Request $request, $index)
    {
        $request->validate([
            'exercise' => 'required|string',
            'result' => 'required|integer',
        ]);

        $exercise = json_decode($request->input('exercise'), true);
        if (!is_array($exercise) || count($exercise) !== 4) {
            return back()->withErrors(['exercise' => 'El ejercicio no es válido.']);
        }

        $result = $request->input('result');
        $correctResult = array_sum($exercise);

        if ($result != $correctResult) {
            return back()->withErrors(['result' => 'El resultado es incorrecto.']);
        }

        // Guardar el ejercicio en la base de datos
        $exerciseModel = new Exercise();
        $exerciseModel->user_id = Auth::id();
        $exerciseModel->values = json_encode($exercise);
        $exerciseModel->result = $result;
        $exerciseModel->save();

        // Marcar el ejercicio como completado en la sesión
        $exercises = session('exercises');
        $exercises[$index]['completed'] = true;
        $exercises[$index]['result'] = $result;
        session(['exercises' => $exercises]);

        return redirect()->route('ejercicio_index')->with('success', 'Ejercicio guardado con éxito.');
    }
}