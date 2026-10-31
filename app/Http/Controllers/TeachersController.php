<?php

namespace App\Http\Controllers;

use App\Models\Teachers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

// Controlador que devuelve respuestas JSON para los instructores.
class TeachersController extends Controller
{
    // Devuelve los instructores con sus areas, centros y cursos asociados.
    public function index(): JsonResponse
    {
        // Consulta los instructores recientes y carga sus relaciones para el cliente.
        return response()->json(
            Teachers::with(['area', 'trainingCenter', 'courses'])->orderByDesc('id')->get()
        );
    }

    // Crea un instructor comprobando que sus relaciones existan.
    public function store(Request $request): JsonResponse
    {
        // Valida los datos del instructor y sus relaciones antes de guardarlo.
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'area_id' => ['nullable', 'integer', 'exists:areas,id'],
            'training_centers_id' => ['nullable', 'integer', 'exists:training_centers,id'],
        ]);

        // Guarda el instructor usando solamente los campos validados.
        $teacher = Teachers::create($data);

        // Devuelve el instructor creado con sus relaciones y estado HTTP 201.
        return response()->json($teacher->load(['area', 'trainingCenter', 'courses']), 201);
    }

    // Devuelve un instructor especifico junto con sus relaciones principales.
    public function show(Teachers $teacher): JsonResponse
    {
        return response()->json($teacher->load(['area', 'trainingCenter', 'courses']));
    }

    // Actualiza los datos del instructor despues de validar la peticion.
    public function update(Request $request, Teachers $teacher): JsonResponse
    {
        // Define las reglas para los datos y relaciones del instructor.
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'area_id' => ['nullable', 'integer', 'exists:areas,id'],
            'training_centers_id' => ['nullable', 'integer', 'exists:training_centers,id'],
        ];

        // PATCH permite modificar solo los campos enviados.
        if ($request->isMethod('PATCH')) {
            foreach ($rules as $field => $fieldRules) {
                $rules[$field] = array_merge(['sometimes'], $fieldRules);
            }
        }

        $data = $request->validate($rules);
        $teacher->update($data);

        // Devuelve el instructor actualizado con sus relaciones.
        return response()->json($teacher->load(['area', 'trainingCenter', 'courses']));
    }

    // Elimina el instructor y confirma la operacion al cliente.
    public function destroy(Teachers $teacher): JsonResponse
    {
        $teacher->delete();

        return response()->json([
            'message' => 'Instructor eliminado correctamente.',
        ]);
    }
}
