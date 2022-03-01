<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;

    protected $table = 'registros';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'status_id',
        'nombre',
        'telefono'
    ];

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
