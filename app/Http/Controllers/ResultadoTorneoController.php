<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResultadoTorneoController extends Controller
{
    public function create(Request $request) {
        $resultado = new ResultadosTorneo();

        $torneo = Torneo::find($request->id_torneo);
        $equipo = Equipos::find($request->id_equipo);
        $modalidad = Modalidad::find($request->id_modalidad);

        if (!$torneo || !$equipo || !$modalidad) {
            return response()->json(['message' => 'Torneo, equipo o modalidad no encontrados'], 404);
        }

        $resultado->torneo()->associate($torneo);
        $resultado->equipo()->associate($equipo);
        $resultado->modalidad()->associate($modalidad);
        $resultado->fehca_fin = $request->fehca_fin;
        $resultado->premio = $request->premio;
        $resultado->save();

        return response()->json([
            "message" => "Guardado exitosamente"
        ], 201);
    }

    public function show(ResultadosTorneo $resultado) {

        return response()->json([
            "data" => $resultado->load(['torneo', 'equipo', 'modalidad']),
            "message" => "Resultado obtenido exitosamente"
        ]);
    }

    public function destroy( ResultadosTorneo $resultado) {
        $resultado->delete();

        return response()->json([
            "message" => "Resultado eliminado Exitosamente!"
        ], 200);
    }

}
