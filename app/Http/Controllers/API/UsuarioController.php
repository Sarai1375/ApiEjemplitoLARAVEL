<?php

namespace App\Http\Controllers\API;

use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{

    // LISTAR
    public function index()
    {
        return response()->json(
            Usuario::with('roles')->get(),
            200
        );
    }

    // CREAR
    public function store(Request $request)
    {

        $data = $request->all();

        $data['password'] = Hash::make($request->password);

        $data['activo'] = 1;

        $usuario = Usuario::create($data);

        return response()->json([
            'message' => 'Usuario creado correctamente',
            'data' => $usuario
        ],201);

    }

    // MOSTRAR
    public function show($id)
    {
        return response()->json(
            Usuario::with('roles')->findOrFail($id)
        );
    }

    // ACTUALIZAR
    public function update(Request $request, $id)
    {

        $usuario = Usuario::findOrFail($id);

        $usuario->update($request->all());

        return response()->json([
            'message' => 'Usuario actualizado'
        ]);

    }

    // ELIMINAR
    public function destroy($id)
    {

        Usuario::destroy($id);

        return response()->json([
            'message' => 'Usuario eliminado'
        ]);

    }

}