<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReporteActividad extends Model
{
    use HasFactory;

    public $timestamps = false; 

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'estado_actividad_id',
        'fecha_inicio',
        'justificacion',
        'documento'
    ];

    protected $table = 'reporte_actividades';

    public function actividad_clientes()
    {
        return $this->belongsTo(ActividadCliente::class);
    }

    public function estado_actividades()
    {
        return $this->belongsTo(EstadoActividad::class, 'estado_actividad_id');
    }

}
