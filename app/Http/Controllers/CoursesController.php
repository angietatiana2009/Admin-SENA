<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

// Controlador que devuelve respuestas JSON para los cursos.
class CoursesController extends Controller
{
    // Devuelve los cursos con sus areas, centros, instructores y aprendices.
    public function index(): JsonResponse
    {
        // Consulta los cursos mas recientes y carga sus relaciones para el cliente.
        return response()->json(
            Courses::with(['area', 'training_center', 'Teachers', 'Apprentices'])
                ->orderByDesc('id')
                ->get()
        );
    }

    // Crea un curso comprobando sus relaciones antes de guardarlo.
    public function store(Request $request): JsonResponse
    {
        // Valida los datos del curso y los instructores que se van a relacionar.
        $data = $request->validate([
            'numero_de_curso' => ['required', 'integer'],
            'day' => ['required', 'string', 'max:255'],
            'area_id' => ['nullable', 'integer', 'exists:areas,id'],
            'training_centers_id' => ['nullable', 'integer', 'exists:training_centers,id'],
            'teacher_ids' => ['nullable', 'array'],
            'teacher_ids.*' => ['integer', 'exists:teachers,id'],
        ]);

        // Separa los instructores porque se guardan en la tabla de relacion.
        $teacherIds = $data['teacher_ids'] ?? [];
        unset($data['teacher_ids']);

        // Guarda el curso y sincroniza los instructores seleccionados.
        $course = Courses::create($data);
        $course->Teachers()->sync($teacherIds);

        // Devuelve el curso creado con sus relaciones y estado HTTP 201.
        return response()->json(
            $course->load(['area', 'training_center', 'Teachers', 'Apprentices']),
            201
        );
    }

    // Devuelve un curso especifico junto con sus relaciones principales.
    public function show(Courses $course): JsonResponse
    {
        return response()->json(
            $course->load(['area', 'training_center', 'Teachers', 'Apprentices'])
        );
    }

    // Actualiza los datos del curso despues de validar la peticion.
    public function update(Request $request, Courses $course): JsonResponse
    {
        // Define las reglas de validacion para los datos y relaciones del curso.
        $rules = [
            'numero_de_curso' => ['required', 'integer'],
            'day' => ['required', 'string', 'max:255'],
            'area_id' => ['nullable', 'integer', 'exists:areas,id'],
            'training_centers_id' => ['nullable', 'integer', 'exists:training_centers,id'],
            'teacher_ids' => ['nullable', 'array'],
            'teacher_ids.*' => ['integer', 'exists:teachers,id'],
        ];

        // PATCH permite modificar solo los campos enviados.
        if ($request->isMethod('PATCH')) {
            foreach ($rules as $field => $fieldRules) {
                $rules[$field] = array_merge(['sometimes'], $fieldRules);
            }
        }

        $data = $request->validate($rules);

        // Sincroniza los instructores solo cuando se incluyeron en la peticion.
        if (array_key_exists('teacher_ids', $data)) {
            $course->Teachers()->sync($data['teacher_ids'] ?? []);
            unset($data['teacher_ids']);
        }

        // Actualiza los campos del curso y devuelve sus relaciones.
        $course->update($data);

        return response()->json(
            $course->load(['area', 'training_center', 'Teachers', 'Apprentices'])
        );
    }

    // Elimina el curso y confirma la operacion al cliente.
    public function destroy(Courses $course): JsonResponse
    {
        $course->delete();

        return response()->json([
            'message' => 'Curso eliminado correctamente.',
        ]);
    }
}
