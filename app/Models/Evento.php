<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'evento_id',
        'criador_id',
        'titulo_evento',
        'imagem_evento',
        'decricao_evento',
        'categoria_id',
        'assunto_id',
        'data_inicio',
        'hora_inicio',
        'data_termino',
        'hora_termino',
        'cep',
        'logradouro',
        'bairro',
        'numero',
        'cidade',
        'uf',
        'lat',
        'lng',
    ];


    protected $primaryKey = 'evento_id';

    public function criador()
    {
        //Relação de N para 1

        return $this->belongsTo(Criador::class, 'criador_id');
       
    }

    public function categoria()
    {
        //Relação de N para 1

        return $this->belongsTo(Categoria::class, 'categoria_id');
       
    }

    public function assunto()
    {
        //Relação de N para 1

        return $this->belongsTo(Assunto::class, 'assunto_id');
       
    }
}
