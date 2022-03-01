<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRegistro extends Model
{
    use HasFactory;

    protected $table = 'user_registros';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'registro_id',
        'status_id',
        'latitud',
        'longitud',
        'respuesta_1',
        'respuesta_2',
        'respuesta_3',
        'tiempo'
    ];

    public function user()
    {
        return $this->belongsTo(
            'App\User',
            'user_id',
            'id'
        )
            ->withDefault();
    }
    public function registro()
    {
        return $this->belongsTo(
            'App\Registro',
            'registro_id',
            'id'
        )
            ->withDefault();
    }
    public function status()
    {
        return $this->belongsTo(
            'App\RegistroStatus',
            'status_id',
            'id'
        )
            ->withDefault();
    }
}
