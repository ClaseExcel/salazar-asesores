<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements CanResetPassword
{
    use HasFactory;
    use Notifiable;
    
    public const activo = 1;
    public const inactivo = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'cedula',
        'nombres',
        'apellidos',
        'cargo_id',
        'rol_id',
        'email',
        'password',
    ];

    protected $table = 'users';

    public function roles()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    public function cargos()
    {
        return $this->belongsTo(Cargo::class, 'cargo_id');
    }

    public function seguimiento_requerimiento()
    {
        return $this->belongsTo(SeguimientoRequerimiento::class);
    }
}
