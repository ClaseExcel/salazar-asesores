<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    public $timestamps = false; 

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'NIT',
        'razon_social',
        'correo_electronico',
        'numero_contacto',
        'direccion_fisica',
        'frecuencia_id'
    ];

    protected $table = 'empresas';

    public function usuarios()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function frecuencias()
    {
        return $this->belongsTo(Frecuencia::class, 'frecuencia_id');
    }

    public function actividad_cliente()
    {
        return $this->hasMany(Actividad::class);
    }
}
