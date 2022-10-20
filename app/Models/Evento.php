<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_evento',
        'id_criador',
        'titulo_evento',
        'imagem_evento',
        'decricao_evento',
        'categoria',
        'assunto',
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


    protected $primaryKey = 'id_evento';

    public function criador()
    {
        //Relação de N para 1

        return $this->belongsTo(Criador::class, 'id_criador');
       
    }

    public function categoria()
    {
        //Relação de N para 1

        return $this->belongsTo(Categoria::class, 'id_categoria' );
       
    }

    public function assunto()
    {
        //Relação de N para 1

        return $this->belongsTo(Assunto::class, 'id_assunto');
       
    }
}