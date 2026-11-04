<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';

    protected $fillable = [
        'nome',
        'nif',
        'email',
        'senha',
        'tipo_usuario',
        'status',
        'data_nascimento'
    ];

    protected $hidden = [
        'senha'
    ];

    protected $casts = [
        'status' => 'boolean',
        'data_nascimento' => 'date'
    ];
}
