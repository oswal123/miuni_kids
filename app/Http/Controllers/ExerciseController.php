<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Exercise;

class ExerciseController extends Controller
{
    public function showExercise()
    {
        return $this->showExerciseByLevel(1);
    }

    public function showExerciseNivel2()
    {
        return $this->showExerciseByLevel(2);
    }

    public function showExerciseNivel3()
    {
        return $this->showExerciseByLevel(3);
    }

    private function showExerciseByLevel($level)
    {
        // Obtener ejercicios completados del usuario actual para el nivel especificado
        $completedExercises = Exercise::where('user_id', Auth::id())->where('level', $level)->get();
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

        session(['exercises' => $exercises, 'level' => $level]);
        return view('ejercicio_nivel' . $level, ['exercises' => $exercises, 'level' => $level]);
    }

    public function showSingleExercise($index)
    {
        $exercises = session('exercises');
        $level = session('level');
        if (!$exercises || !isset($exercises[$index])) {
            return redirect()->route('ejercicio_nivel' . $level);
        }

        $exercise = $exercises[$index];
        return view('show_exercise', ['exercise' => $exercise, 'index' => $index, 'level' => $level]);
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
        $exerciseModel->level = session('level'); // Guardar el nivel actual
        $exerciseModel->save();

        // Marcar el ejercicio como completado en la sesión
        $exercises = session('exercises');
        $exercises[$index]['completed'] = true;
        $exercises[$index]['result'] = $result;
        session(['exercises' => $exercises]);

        return redirect()->route('ejercicio_nivel' . session('level'))->with('success', 'Ejercicio guardado con éxito.');
    }

    public function reiniciarNivel()
    {
        $level = session('level');
        // Eliminar los ejercicios completados del usuario actual para el nivel actual
        Exercise::where('user_id', Auth::id())->where('level', $level)->delete();

        // Eliminar los ejercicios de la sesión
        session()->forget('exercises');

        // Redirigir a la página de ejercicios del nivel actual
        return redirect()->route('ejercicio_nivel' . $level)->with('success', 'Nivel reiniciado con éxito.');
    }
}