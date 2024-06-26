<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use Illuminate\Support\Facades\Validator;
use App\Models\usuario;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()    {
        $usuario = Usuario::all();

        

        $data = [
            'usuarios'=> $usuario,
            'status' => 200
        ];

        return response()->json($data,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator =  Validator::make($request->all(),[
            'nombres' => 'required|max:255',
            'apellido' => 'required',
            'cedula' => 'required',
            'correo' => 'required|email|unique:usuario',
            'dirrecion' => 'required'
        ]);

        if($validator->fails()){
            $data=[
                'message' => 'Error en la validacion de datos',
                'errors' => $validator->errors(),
                'status' => 400 
            ];
            return response()-> json($data, 400);
        }

        $usuario = usuario::create([
            'nombres' => $request->nombres,
            'apellido' => $request->apellido,
            'cedula' => $request->cedula,
            'correo' => $request->correo,
            'dirrecion' => $request->dirrecion
            
        ]);

        if(!$usuario){
            $data = [
                'message'=>'Error al crear usuario',
                'status'
            ];
            return response()->json($data,500);
        };

        $data = [
            'Usuario' => $usuario,
            'status' => 201
        ];

        return response()->json($data,201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $usuario = Usuario::find($id);

        if (!$usuario){
            $data = [
                'message' => 'usuario no encontrado',
                'status' => 200
            ];
        };
        
        $data = [
            'usuario' => $usuario,
            'status' => 200
        ];

        return response()->json($data,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $usuario = Usuario::find($id);

        if (!$usuario){
            $data = [
                'message' => 'usuario no encontrado',
                'status' => 200
            ];

        };


        $validator =  Validator::make($request->all(),[
            'nombres' => 'required|max:255',
            'apellido' => 'required',
            'cedula' => 'required',
            'correo' => 'required|email|unique:usuario',
            'dirrecion' => 'required'
        ]);

        if($validator->fails()){
            $data=[
                'message' => 'Error en la validacion de datos',
                'errors' => $validator->errors(),
                'status' => 400 
            ];
            return response()-> json($data, 400);
        }

        $usuario->nombres = $request->nombres;
        $usuario->apellido = $request->apellido;
        $usuario->cedula = $request->cedula;
        $usuario->correo = $request->correo;
        $usuario->dirrecion = $request->dirrecion;

        $usuario->save();
        $data= [
            'message' => 'Usuario Actualizado',
            'usuario' => $usuario,
            'status' => 200,
        ];
        return response()->json($data,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $usuario = Usuario::find($id);

        if (!$usuario){
            $data = [
                'message' => 'usuario no encontrado',
                'status' => 200
            ];
        };

        $usuario->delete();

        $data = [
            'message' => 'Usuario eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);

    }
}
