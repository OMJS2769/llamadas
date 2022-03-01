<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroStatus extends Model
{
    use HasFactory;

    protected $table = 'registro_statuses';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'status',
    ];
}
