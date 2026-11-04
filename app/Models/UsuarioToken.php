<?php

namespace App\Models;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\BelongsTo;

class UsuarioToken extends Model
{
    protected $table = 'usuario_token';

    protected $fillable = [
        'usuario_id',
        'token',
        'valido_ate',
    ];

    

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
