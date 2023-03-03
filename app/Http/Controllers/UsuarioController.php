<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::with('nivel')->get();
        return response()->json($usuarios, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'observation' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'status' => 'boolean',
            'nivel_id' => 'required|integer|exists:nivels,id',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        return DB::transaction(function () use ($request) {

            $usuario = Usuario::create([
                'name' => $request->name,
                'observation' => $request->observation,
                'status' => $request->status,
                'password' => $request->password,
                'nivel_id' => $request->nivel_id,

            ]);
            return response()->json([
                'usuario' => $usuario,
                'status' => 200
            ]);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {

            $usuario = Usuario::find($id);
            if (!$usuario) {
                return response()->json(['error' => 'No se encontro el usuario', 'status' => 404]);
            }
            return response()->json([
                'usuario' => $usuario,
                'status' => 200
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {



        try {

            $usuario = Usuario::find($id);
            if (!$usuario) {
                return response()->json(['error' => 'No se encontro el usuario', 'status' => 404]);
            }


            $validator = Validator::make($request->all(), [
                'name' => 'string|max:255',
                'observation' => 'string|max:255',
                'password' => 'string|max:255',
                'status' => 'boolean',
                'nivel_id' => 'integer|exists:nivels,id',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }

            return DB::transaction(function () use ($usuario, $request) {
                $usuario->update([
                    'name' => $request->name ?? $usuario->name,
                    'observation' => $request->observation ?? $usuario->observation,
                    'password' => $request->password ?? $usuario->password,
                    'status' => $request->status ?? $usuario->status,
                    'nivel_id' => $request->nivel_id ?? $usuario->nivel_id,

                ]);
                return response()->json([
                    'usuario' => $usuario,
                    'status' => 200
                ]);
            }, 5);
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['error' => 'No se encontro el usuario', 'status' => 404]);
        }
        $usuario->delete();
        return response()->json([
            'usuario' => 'usuario eliminado',
            'status' => 200
        ]);
    }
}
