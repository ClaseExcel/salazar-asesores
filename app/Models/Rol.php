<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    public $timestamps = false; 

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nombre',
    ];

    protected $table = 'roles';

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function clientes()
    {
        return $this->belongsToMany(Cliente::class);
    }
}
