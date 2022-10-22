<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assunto extends Model
{
    use HasFactory;

    protected $fillable = [
        'assunto_id',
        'name_assunto',
        
    ];

    protected $primaryKey = 'assunto_id';

    public function eventos()
    {
        return $this->hasMany(Evento::class, 'evento_id');
    }
}
