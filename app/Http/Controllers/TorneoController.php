<?php

namespace App\Http\Controllers;

use App\Models\VideoJuego;
use Illuminate\Http\Request;
use App\Models\Torneo;
class TorneoController extends Controller
{
    public function create(Request $request) {
        $torneo=Torneo::create([
            "nombre" => $request->nombre,
            "premio" => $request->premio,
            "fecha_inicio" => $request->fecha_inicio,
            "fecha_fin" => $request->fecha_fin,
            "id_modalidad" => $request->id_modalidad,
            "limite_equipos" => $request->limite_equipos,

        ]);

        $torneo->videojuego()->associate($request->videojuego);
        $torneo->save();

        return response()->json([
            "message" => "Torneo Guardado Exitosamente!"
        ], 201);
    }

    public function update(Request $request, Torneo $torneo){
        $torneo->update([
            "nombre" => $request->nombre,
            "premio" => $request->premio,
            "fecha_inicio"=> $request->fecha_inicio,
            "fecha_fin"=> $request->fecha_fin,
            "id_modalidad" => $request->id_modalidad,
            "limite_equipos" => $request->limite_equipos,
        ]);

        return response()->json([
            "message" => "Actualizado exitosamente"
        ],200);
    }

    public function destroy( Torneo $torneo) {
        $torneo->delete();
        return response()->json([
            "message" => "Tipo de video juego eliminado Exitosamente!"
        ], 200);
    }

    public function index() {
        return response()->json([
            "data" => Torneo::with('videojuego')->get(),
            "message" => "Lista de torneos obtenida exitosamente"
        ]);
    }

    public  function getAll() {
        $equipo = Torneo::with('videojuego')->get();
        return response()->json([
            "data" => $equipo,
            "message" => "Consuta Equipos Exitosamente!"
        ],200);
    }

}
