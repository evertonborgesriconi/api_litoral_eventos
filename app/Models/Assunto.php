<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assunto extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_assunto',
        'name_assunto',
        
    ];

    protected $primaryKey = 'id_assunto';

    public function eventos()
    {
        return $this->hasMany(Evento::class, 'id_evento');
    }
}
