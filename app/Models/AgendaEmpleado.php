<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaEmpleado extends Model
{
    use HasFactory;

    public $timestamps = false; 

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'fecha_disponibilidad',
        'hora_inicio',
        'hora_fin',
        'user_id',
        'empresa_id',
    ];

    protected $table = 'agenda_empleados';

    public function usuarios()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function clientes()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function citas()
    {
        return $this->belongsTo(Cita::class);
    }

}
