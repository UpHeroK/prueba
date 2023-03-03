<?php

namespace App\Http\Controllers;

use App\Models\Nivel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use App\Models\Alumno;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Response;

class NivelController extends Controller
{ /**
    * Display a listing of the resource.
    */
   public function index()
   {
      $niveles = Nivel::all();
        return response()->json($niveles, 200);
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(Request $request)
   {
       $validator= Validator::make($request->all(),[
           'name' => 'required|string|max:255',
           

       ]);
       if ($validator->fails()) {
           return response()->json($validator->errors()->toJson(), 400);
       }
       return DB::transaction(function () use ($request) {

           $nivel = Nivel::create([
               'name' => $request->name,
               
           ]);
           return response()->json([
               'nivel' => $nivel,
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

      $nivel = Nivel::find($id);
      if (!$nivel) {
           return response()->json(['error' => 'No se encontro el nivel', 'status' => 404]);
      }
         return response()->json([
             'nivel' => $nivel,
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
        
        $nivel = Nivel::find($id);
        if (!$nivel) {
            return response()->json(['error' => 'No se encontro el nivel', 'status' => 404]);
        }
        

        $validator=Validator::make($request->all(),[
            'name'=> 'string|max:255',
            
        ]);
        if ($validator->fails()) {
         return response()->json($validator->errors()->toJson(), 400);
     }

        return DB::transaction(function () use ($nivel , $request) {
            $nivel->update([
                'name'=> $request->name ?? $nivel->name,
              
             
            ]);
            return response()->json([
             'nivel' => $nivel,
             'status' => 200
         ]);
        },5);
        
     } catch (\Throwable $th) {
         throw $th;
     }

   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy($id)
   {

       $nivel = Nivel::find($id);
       if (!$nivel) {
           return response()->json(['error' => 'No se encontro el nivel', 'status' => 404]);
       }
if ($nivel->usuario()->count() > 0) {
    return response()->json(['error' => 'No se puede eliminar el nivel porque tiene usuarios asociados', 'status' => 404]);
}

       $nivel->delete();
       return response()->json([
           'nivel' => 'nivel eliminado',
           'status' => 200
       ]);
   }
}
