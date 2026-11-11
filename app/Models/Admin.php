<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'login';

    protected $fillable = [
        'usuario_id',
        'senha',
    ];  
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
