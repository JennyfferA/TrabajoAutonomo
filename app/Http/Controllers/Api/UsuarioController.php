<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('custom.auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = Usuario::all();

        $data = [
            'usuarios'=> $usuario,
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
            'nombres' => 'required|max:255',
            'apellido' => 'required',
            'cedula' => 'required',
            'correo' => 'required|email|unique:usuario',
            'direccion' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $usuario = Usuario::create([
            'nombres' => $request->nombres,
            'apellido' => $request->apellido,
            'cedula' => $request->cedula,
            'correo' => $request->correo,
            'direccion' => $request->direccion
        ]);

        if (!$usuario) {
            $data = [
                'message' => 'Error al crear usuario',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'Usuario' => $usuario,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'usuario' => $usuario,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombres' => 'required|max:255',
            'apellido' => 'required',
            'cedula' => 'required',
            'correo' => 'required|email|unique:usuario,correo,' . $id,
            'direccion' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $usuario->nombres = $request->nombres;
        $usuario->apellido = $request->apellido;
        $usuario->cedula = $request->cedula;
        $usuario->correo = $request->correo;
        $usuario->direccion = $request->direccion;

        $usuario->save();

        $data = [
            'message' => 'Usuario actualizado',
            'usuario' => $usuario,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $usuario->delete();

        $data = [
            'message' => 'Usuario eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
