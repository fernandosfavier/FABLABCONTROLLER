<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $table = 'sala';

    protected $fillable = [
        'nome',
        'bloco',
        'observacao'
    ];

    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class, 'sala_id');
    }
}
