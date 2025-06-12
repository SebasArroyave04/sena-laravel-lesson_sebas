<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Torneo extends Model
{
    protected $primaryKey = "id_torneo";
    protected $fillable = [
        "id_torneo",
        "nombre",
        "premio",
        "fecha_inicio",
        "fecha_fin",
        "id_videojuego",
        "limite_equipos",
        "id_modalidad"
    ];

    public function videojuego(){
        return $this->belongsTo(VideoJuego::class, "id_videojuego");
    }

    public function equipos(){
        return $this->belongsToMany(Equipos::class,"equipo_torneo","id_torneo", "id_equipo");
    }

    public function resultado(){
        return $this->belongsTo(ResultadosTorneo::class,"resultados_torneo","id_torneo","id_resultados");
    }

}
