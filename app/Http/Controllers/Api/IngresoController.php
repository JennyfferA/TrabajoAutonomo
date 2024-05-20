<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Ingreso;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingresos = Ingreso::all();

        $data = [
            'ingresos' => $ingresos,
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
            'fecha_ingreso' => 'required|date',
            'duracion_estacionamiento' => 'required|integer',
            'id_reserva' => 'required|integer|exists:reservas,id_reserva'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $ingreso = Ingreso::create([
            'fecha_ingreso' => $request->fecha_ingreso,
            'duracion_estacionamiento' => $request->duracion_estacionamiento,
            'id_reserva' => $request->id_reserva
        ]);

        if (!$ingreso) {
            $data = [
                'message' => 'Error al crear ingreso',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'ingreso' => $ingreso,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ingreso = Ingreso::find($id);

        if (!$ingreso) {
            $data = [
                'message' => 'Ingreso no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'ingreso' => $ingreso,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ingreso = Ingreso::find($id);

        if (!$ingreso) {
            $data = [
                'message' => 'Ingreso no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'fecha_ingreso' => 'required|date',
            'duracion_estacionamiento' => 'required|integer',
            'id_reserva' => 'required|integer|exists:reservas,id_reserva'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $ingreso->fecha_ingreso = $request->fecha_ingreso;
        $ingreso->duracion_estacionamiento = $request->duracion_estacionamiento;
        $ingreso->id_reserva = $request->id_reserva;

        $ingreso->save();

        $data = [
            'message' => 'Ingreso actualizado',
            'ingreso' => $ingreso,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ingreso = Ingreso::find($id);

        if (!$ingreso) {
            $data = [
                'message' => 'Ingreso no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $ingreso->delete();

        $data = [
            'message' => 'Ingreso eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
