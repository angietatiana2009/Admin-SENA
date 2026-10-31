<?php

namespace App\Http\Controllers;

use App\Models\Areas;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

// Controlador que devuelve respuestas JSON para el recurso areas.
class AreasController extends Controller
{
    // Devuelve las areas recientes con sus cursos e instructores asociados.
    public function index(): JsonResponse
    {
        // Consulta la tabla areas y prepara una respuesta JSON para el cliente.
        return response()->json(
            Areas::with(['courses', 'teachers'])->orderByDesc('id')->get()
        );
    }

    // Crea una nueva area con los datos recibidos desde la API.
    public function store(Request $request): JsonResponse
    {
        // Valida que el nombre exista, sea texto y no supere 255 caracteres.
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        // Guarda el registro usando solamente los campos validados.
        $area = Areas::create($data);

        // Devuelve el registro creado y sus relaciones con estado HTTP 201.
        return response()->json($area->load(['courses', 'teachers']), 201);
    }

    // Devuelve un area especifica usando su identificador de la URL.
    public function show(Areas $area): JsonResponse
    {
        // Laravel inyecta automaticamente el registro solicitado.
        return response()->json($area->load(['courses', 'teachers']));
    }

    // Actualiza un area existente con los datos enviados por la API.
    public function update(Request $request, Areas $area): JsonResponse
    {
        // Valida el nombre antes de modificar el registro.
        $rules = [
            'name' => ['required', 'string', 'max:255'],
        ];

        // PATCH permite actualizar solo los campos enviados.
        if ($request->isMethod('PATCH')) {
            $rules['name'] = array_merge(['sometimes'], $rules['name']);
        }

        $data = $request->validate($rules);
        $area->update($data);

        // Devuelve el registro actualizado y sus relaciones.
        return response()->json($area->load(['courses', 'teachers']));
    }

    // Elimina un area especifica usando el enlace de modelo de Laravel.
    public function destroy(Areas $area): JsonResponse
    {
        $area->delete();

        // Confirma al cliente que la eliminacion fue realizada.
        return response()->json([
            'message' => 'Registro eliminado correctamente.',
        ]);
    }
}
