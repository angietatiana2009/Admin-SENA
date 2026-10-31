<?php

namespace App\Http\Controllers;

use App\Models\Apprentices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

// Controlador que devuelve respuestas JSON para los aprendices.
class ApprenticesController extends Controller
{
    // Devuelve los aprendices con el curso y el computador asociados.
    public function index(): JsonResponse
    {
        $apprentices = Apprentices::with('computer', 'course')
            ->orderByDesc('id')
            ->get();

        return response()->json($apprentices);
    }

    // Crea un aprendiz comprobando que sus relaciones existan.
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'cell_number' => ['required', 'string', 'max:20'],
            'course_id' => ['nullable', 'exists:courses,id'],
            'computer_id' => ['nullable', 'exists:computers,id'],
        ]);

        $apprentice = Apprentices::create($data);

        return response()->json($apprentice->load('computer', 'course'), 201);
    }

    // Devuelve un aprendiz especifico junto con sus relaciones.
    public function show(Apprentices $apprentice): JsonResponse
    {
        return response()->json($apprentice->load('computer', 'course'));
    }

    // Actualiza solo la informacion validada del aprendiz.
    public function update(Request $request, Apprentices $apprentice): JsonResponse
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'cell_number' => ['required', 'string', 'max:20'],
            'course_id' => ['nullable', 'exists:courses,id'],
            'computer_id' => ['nullable', 'exists:computers,id'],
        ];

        if ($request->isMethod('PATCH')) {
            foreach ($rules as $field => $fieldRules) {
                $rules[$field] = array_merge(['sometimes'], $fieldRules);
            }
        }

        $data = $request->validate($rules);
        $apprentice->update($data);

        return response()->json($apprentice->load('computer', 'course'));
    }

    // Elimina el aprendiz y devuelve un mensaje de confirmacion.
    public function destroy(Apprentices $apprentice): JsonResponse
    {
        $apprentice->delete();

        return response()->json([
            'message' => 'Aprendiz eliminado correctamente.',
        ]);
    }
}
