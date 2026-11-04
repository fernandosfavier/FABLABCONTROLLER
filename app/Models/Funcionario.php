<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = 'funcionario';

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

    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class, 'funcionario_id');
    }
}
