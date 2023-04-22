<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Vehiculo;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehiculos = Vehiculo::all();

        $data = [
            'vehiculos' => $vehiculos,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'usuario_id' => 'required|exists:usuario,id',
            'placa' => 'required|string|max:10',
            'marca' => 'required|string|max:50',
            'modelo' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $vehiculo = Vehiculo::create($request->all());

        if (!$vehiculo) {
            $data = [
                'message' => 'Error al crear vehículo',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'vehiculo' => $vehiculo,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vehiculo = Vehiculo::find($id);

        if (!$vehiculo) {
            $data = [
                'message' => 'Vehículo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'vehiculo' => $vehiculo,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Buscar el vehículo por su ID
    $vehiculo = Vehiculo::find($id);

    // Verificar si el vehículo existe
    if (!$vehiculo) {
        // Si el vehículo no existe, devolver una respuesta de error
        return response()->json(['message' => 'Vehículo no encontrado'], 404);
    }

    // Validar los datos de la solicitud
    $validator = Validator::make($request->all(), [
        'modelo' => 'required|max:50',
        'placa' => 'required|max:10',
        'marca' => 'required|max:50',
    ]);

    // Verificar si la validación falla
    if ($validator->fails()) {
        // Si la validación falla, devolver los errores de validación
        return response()->json(['errors' => $validator->errors()], 400);
    }

    // Actualizar los campos del vehículo
    $vehiculo->modelo = $request->input('modelo');
    $vehiculo->placa = $request->input('placa');
    $vehiculo->marca = $request->input('marca');

    // Guardar los cambios en la base de datos
    $vehiculo->save();

    // Devolver una respuesta exitosa
    return response()->json(['message' => 'Vehículo actualizado correctamente'], 200);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vehiculo = Vehiculo::find($id);

        if (!$vehiculo) {
            $data = [
                'message' => 'Vehículo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $vehiculo->delete();

        $data = [
            'message' => 'Vehículo eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}