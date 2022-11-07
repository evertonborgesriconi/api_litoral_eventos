<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class LocalVendaIngresso extends Model
{
    use HasFactory;
    protected $fillable = [
        'local_id',
        'evento_id',
        'nome_local',
        'endereco'
    ];

    protected $primaryKey = 'local_id';

    public function evento()
    {
        //Relação de N para 1
        return $this->belongsTo(Evento::class, 'evento_id');

    }
}
