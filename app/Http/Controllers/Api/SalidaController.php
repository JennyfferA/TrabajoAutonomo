<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Salida;

class SalidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salidas = Salida::all();

        $data = [
            'salidas' => $salidas,
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
            'fecha_salida' => 'required|date',
            'duracion_estacionamiento' => 'required|integer',
            'id_ingreso' => 'required|integer|exists:ingresos,id_ingreso'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $salida = Salida::create([
            'fecha_salida' => $request->fecha_salida,
            'duracion_estacionamiento' => $request->duracion_estacionamiento,
            'id_ingreso' => $request->id_ingreso
        ]);

        if (!$salida) {
            $data = [
                'message' => 'Error al crear salida',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'salida' => $salida,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $salida = Salida::find($id);

        if (!$salida) {
            $data = [
                'message' => 'Salida no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'salida' => $salida,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $salida = Salida::find($id);

        if (!$salida) {
            $data = [
                'message' => 'Salida no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'fecha_salida' => 'required|date',
            'duracion_estacionamiento' => 'required|integer',
            'id_ingreso' => 'required|integer|exists:ingresos,id_ingreso'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $salida->fecha_salida = $request->fecha_salida;
        $salida->duracion_estacionamiento = $request->duracion_estacionamiento;
        $salida->id_ingreso = $request->id_ingreso;

        $salida->save();

        $data = [
            'message' => 'Salida actualizada',
            'salida' => $salida,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $salida = Salida::find($id);

        if (!$salida) {
            $data = [
                'message' => 'Salida no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $salida->delete();

        $data = [
            'message' => 'Salida eliminada',
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
