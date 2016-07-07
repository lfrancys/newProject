<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public $incrementing = false;

    protected $table = 'categoria';

    protected $fillable = [
        'id'
    ];

}
