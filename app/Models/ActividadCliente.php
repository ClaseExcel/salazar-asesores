<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadCliente extends Model
{
    use HasFactory;

    protected $table = 'actividad_cliente';

    protected $fillable = [
        'nombre',
        'actividad_id',
        'progreso',
        'prioridad',
        'fecha_vencimiento',
        'periodicidad',
        // 'periodicidad_corte',
        'recordatorio',
        'recordatorio_distancia',
        'nota',
        'responsable_id',
        'cliente_id',
        'usuario_id',
        'reporte_actividad_id',
        'empresa_asociada_id',
        'file_documento_1',
        'file_documento_2',
        'file_documento_3',
        'file_documento_4',
        'file_documento_5',
    ];

    public function actividad()
    {
        return $this->belongsTo(Actividad::class, 'actividad_id');
    }

    public function responsable()
    {
        return $this->belongsTo(Responsable::class, 'responsable_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Empresa::class, 'cliente_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function reporte_actividades()
    {
        return $this->belongsTo(ReporteActividad::class, 'reporte_actividad_id');
    }

    public function empresa_asociada()
    {
        return $this->belongsTo(Empresa::class, 'empresa_asociada_id');
    }
}
