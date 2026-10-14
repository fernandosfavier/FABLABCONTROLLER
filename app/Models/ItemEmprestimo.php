<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemEmprestimo extends Model
{
    protected $table = 'item_emprestimo';

    protected $fillable = [
        'emprestimo_id',
        'equipamento_id',
        'estado_retirada',
        'estado_devolucao',
        'observacao'
    ];

    public function emprestimo()
    {
        return $this->belongsTo(Emprestimo::class, 'emprestimo_id');
    }

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class, 'equipamento_id');
    }
}