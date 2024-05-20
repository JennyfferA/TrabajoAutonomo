<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Espacio;

class EspacioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $espacios = Espacio::all();

        $data = [
            'espacios' => $espacios,
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
            'numero_parqueadero' => 'required|integer',
            'disponible' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $espacio = Espacio::create([
            'numero_parqueadero' => $request->numero_parqueadero,
            'disponible' => $request->disponible
        ]);

        if (!$espacio) {
            $data = [
                'message' => 'Error al crear espacio',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'espacio' => $espacio,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $espacio = Espacio::find($id);

        if (!$espacio) {
            $data = [
                'message' => 'Espacio no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'espacio' => $espacio,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $espacio = Espacio::find($id);

        if (!$espacio) {
            $data = [
                'message' => 'Espacio no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'numero_parqueadero' => 'required|integer',
            'disponible' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $espacio->numero_parqueadero = $request->numero_parqueadero;
        $espacio->disponible = $request->disponible;
        $espacio->save();

        $data = [
            'message' => 'Espacio actualizado',
            'espacio' => $espacio,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $espacio = Espacio::find($id);

        if (!$espacio) {
            $data = [
                'message' => 'Espacio no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $espacio->delete();

        $data = [
            'message' => 'Espacio eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
