<?php
namespace App\Services;

use Illuminate\Database\DatabaseManager;
use App\Entities\Categoria;
use Illuminate\Database\Eloquent\Model;

class CategoriaService  extends ServiceAbstract
{
    protected function makeEntity():Model
    {
        return app(Categoria::class);
    }
}