<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    protected $table = 'emprestimo';

    protected $fillable = [
        'funcionario_id',
        'sala_id',
        'data_retirada',
        'data_prevista_devolucao',
        'data_devolucao',
        'status',
        'observacao'
    ];

    protected $casts = [
        'data_retirada' => 'datetime',
        'data_prevista_devolucao' => 'datetime',
        'data_devolucao' => 'datetime'
    ];

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'funcionario_id');
    }

    public function sala()
    {
        return $this->belongsTo(Sala::class, 'sala_id');
    }

    public function itens()
    {
        return $this->hasMany(ItemEmprestimo::class, 'emprestimo_id');
    }
}