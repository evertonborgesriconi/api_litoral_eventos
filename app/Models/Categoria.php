<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_categoria',
        'nome_categoria',
        
    ];

    protected $primaryKey = 'id_categoria';

    public function eventos()
    {
        return $this->hasMany(Evento::class, 'id_evento');
    }
}
