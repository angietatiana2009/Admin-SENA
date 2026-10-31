<?php

namespace App\Http\Controllers;

use App\Models\Computers;
use Cloudinary\Cloudinary;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

// Controlador que devuelve respuestas JSON para los computadores.
class ComputersController extends Controller
{
    // Devuelve los computadores recientes con sus aprendices asociados.
    public function index(): JsonResponse
    {
        // Consulta la tabla computers y prepara una respuesta JSON para el cliente.
        return response()->json(
            Computers::with('apprentices')->orderByDesc('id')->get()
        );
    }

    // Crea un computador con los datos recibidos desde la API.
    public function store(Request $request): JsonResponse
    {
        // Valida los datos del computador y la imagen que se subira a Cloudinary.
        $data = $request->validate([
            'number' => ['required', 'integer'],
            'brand' => ['required', 'string', 'max:255'],
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
                'folder' => 'computers',
                'resource_type' => 'image',
            ]
        );

        $computer = Computers::create([
            'number' => $data['number'],
            'brand' => $data['brand'],
            'imagen_url' => $result['secure_url'],
            'imagen_public_id' => $result['public_id'],
        ]);

        // Devuelve el computador creado con sus aprendices y estado HTTP 201.
        return response()->json($computer->load('apprentices'), 201);
    }

    // Devuelve un computador especifico mediante el enlace de modelo de Laravel.
    public function show(Computers $computer): JsonResponse
    {
        // Incluye los aprendices asociados al computador.
        return response()->json($computer->load('apprentices'));
    }

    // Actualiza los datos del computador despues de validarlos.
    public function update(Request $request, Computers $computer): JsonResponse
    {
        // Valida el numero y la marca antes de modificar el registro.
        $rules = [
            'number' => ['required', 'integer'],
            'brand' => ['required', 'string', 'max:255'],
        ];

        // PATCH permite actualizar solo los campos enviados.
        if ($request->isMethod('PATCH')) {
            foreach ($rules as $field => $fieldRules) {
                $rules[$field] = array_merge(['sometimes'], $fieldRules);
            }
        }

        $data = $request->validate($rules);
        $computer->update($data);

        // Devuelve el computador actualizado con sus aprendices asociados.
        return response()->json($computer->load('apprentices'));
    }

    // Elimina el computador y confirma la operacion al cliente.
    public function destroy(Computers $computer): JsonResponse
    {
        $computer->delete();

        return response()->json([
            'message' => 'Computador eliminado correctamente.',
        ]);
    }
}
