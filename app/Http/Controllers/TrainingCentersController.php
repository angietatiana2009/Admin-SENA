<?php

namespace App\Http\Controllers;

use App\Models\TrainingCenters;
use Cloudinary\Cloudinary;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

// Controlador que devuelve respuestas JSON para los centros de formacion.
class TrainingCentersController extends Controller
{
    // Devuelve los centros con sus cursos e instructores asociados.
    public function index(): JsonResponse
    {
        // Consulta los centros mas recientes y carga sus relaciones para el cliente.
        return response()->json(
            TrainingCenters::with(['courses', 'teachers'])->orderByDesc('id')->get()
        );
    }

    // Crea un centro comprobando sus datos antes de guardarlo.
    public function store(Request $request): JsonResponse
    {
        // Valida los datos del centro y la imagen que se subira a Cloudinary.
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'imagen' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $file = $request->file('imagen');

        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => config('services.cloudinary.cloud_name'),
                'api_key' => config('services.cloudinary.api_key'),
                'api_secret' => config('services.cloudinary.api_secret'),
            ],
            'url' => ['secure' => true],
        ]);

        $result = $cloudinary->uploadApi()->upload(
            $file->getRealPath(),
            [
                'folder' => 'training_centers',
                'resource_type' => 'image',
            ]
        );

        $trainingCenter = TrainingCenters::create([
            'name' => $data['name'],
            'location' => $data['location'],
            'imagen_url' => $result['secure_url'],
            'imagen_public_id' => $result['public_id'],
        ]);

        // Devuelve el centro creado con sus relaciones y estado HTTP 201.
        return response()->json($trainingCenter->load(['courses', 'teachers']), 201);
    }

    // Devuelve un centro especifico junto con sus relaciones principales.
    public function show(TrainingCenters $trainingCenter): JsonResponse
    {
        return response()->json($trainingCenter->load(['courses', 'teachers']));
    }

    // Actualiza los datos del centro despues de validar la peticion.
    public function update(Request $request, TrainingCenters $trainingCenter): JsonResponse
    {
        // Define las reglas de validacion para el nombre y la ubicacion.
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
        ];

        // PATCH permite modificar solo los campos enviados.
        if ($request->isMethod('PATCH')) {
            foreach ($rules as $field => $fieldRules) {
                $rules[$field] = array_merge(['sometimes'], $fieldRules);
            }
        }

        $data = $request->validate($rules);
        $trainingCenter->update($data);

        // Devuelve el centro actualizado con sus relaciones.
        return response()->json($trainingCenter->load(['courses', 'teachers']));
    }

    // Elimina el centro y confirma la operacion al cliente.
    public function destroy(TrainingCenters $trainingCenter): JsonResponse
    {
        $trainingCenter->delete();

        return response()->json([
            'message' => 'Centro de formacion eliminado correctamente.',
        ]);
    }
}
