<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Reserva;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservas = Reserva::all();

        $data = [
            'reservas' => $reservas,
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
            'fecha_ini' => 'required|date',
            'fecha_fin' => 'required|date',
            'activa' => 'required|boolean',
            'id_vehiculo' => 'required|integer|exists:vehiculos,id',
            'id_parqueadero' => 'required|integer|exists:espacios,id_parqueadero'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $reserva = Reserva::create([
            'fecha_ini' => $request->fecha_ini,
            'fecha_fin' => $request->fecha_fin,
            'activa' => $request->activa,
            'id_vehiculo' => $request->id_vehiculo,
            'id_parqueadero' => $request->id_parqueadero
        ]);

        if (!$reserva) {
            $data = [
                'message' => 'Error al crear reserva',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'reserva' => $reserva,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reserva = Reserva::find($id);

        if (!$reserva) {
            $data = [
                'message' => 'Reserva no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'reserva' => $reserva,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reserva = Reserva::find($id);

        if (!$reserva) {
            $data = [
                'message' => 'Reserva no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'fecha_ini' => 'required|date',
            'fecha_fin' => 'required|date',
            'activa' => 'required|boolean',
            'id_vehiculo' => 'required|integer|exists:vehiculos,id',
            'id_parqueadero' => 'required|integer|exists:espacios,id_parqueadero'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $reserva->fecha_ini = $request->fecha_ini;
        $reserva->fecha_fin = $request->fecha_fin;
        $reserva->activa = $request->activa;
        $reserva->id_vehiculo = $request->id_vehiculo;
        $reserva->id_parqueadero = $request->id_parqueadero;

        $reserva->save();

        $data = [
            'message' => 'Reserva actualizada',
            'reserva' => $reserva,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reserva = Reserva::find($id);

        if (!$reserva) {
            $data = [
                'message' => 'Reserva no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $reserva->delete();

        $data = [
            'message' => 'Reserva eliminada',
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
