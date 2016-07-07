<?php

namespace App\Legacy\Entities;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'idCategoria',
        'nome',
        'preco',
        'descricao',
        'foto',
        'idProduto'
    ];

    public static $snakeAttributes = false;

    function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->connection = 'sqlite';
    }

    public function Categoria(){
        return $this->belongsTo(Categoria::class, 'idCategoria');
    }
}
