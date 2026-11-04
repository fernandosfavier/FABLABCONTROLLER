<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
    protected $table = 'equipamento';

    protected $fillable = [
        'patrimonio',
        'nome',
        'tipo',
        'modelo',
        'status',
        'observacao'
    ];

    public function itensEmprestimo()
    {
        return $this->hasMany(ItemEmprestimo::class, 'equipamento_id');
    }
}
