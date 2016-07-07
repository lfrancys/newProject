<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nome',
        'idCategoria',
        'preco',
        'descricao',
        'foto'
    ];

    public function Categoria(){
        return $this->belongsTo(Categoria::class, 'idCategoria');
    }
}
