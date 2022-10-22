<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoria_id',
        'nome_categoria',
        
    ];

    protected $primaryKey = 'categoria_id';

    public function eventos()
    {
        return $this->hasMany(Evento::class, 'evento_id');
    }
}
