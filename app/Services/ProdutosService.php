<?php
namespace App\Services;

use Illuminate\Database\DatabaseManager;
use App\Entities\Produto;
use Illuminate\Database\Eloquent\Model;
use App\Legacy\Services\ProdutosService as ProdutosServiceLegacy;

class ProdutosService extends ServiceAbstract {

    protected $categoriaService;
    protected $legacyProdutoService;

    protected function makeEntity():Model
    {
        return app(Produto::class);
    }

    function __construct(DatabaseManager $db, CategoriaService $categoriaService, ProdutosServiceLegacy $legacyProdutoService)
    {
        parent::__construct($db);
        $this->categoriaService = $categoriaService;
        $this->legacyProdutoService = $legacyProdutoService;
    }


    public function create(array $data){

        $produto = parent::create($data); //salva no banco novo
        $data['idProduto'] = $produto->id;//armazena o id
        $this->legacyProdutoService->create($data);//salva no banco velho

        return $produto;
    }

    public function update(array $data, $id){

        $produto = parent::update($data, $id); //atualiza no banco novo

        $produtoLegacy = $this->legacyProdutoService->where(['idProduto' => $id])->first(); // pega o produto no banco velho

        $this->legacyProdutoService->update($data, $produtoLegacy->id); //atualiza no banco velho


        return $produto;
    }

    public function destroy($id){

        $produtoLegacy = $this->legacyProdutoService->where('idProduto', '=', $id)->first(); //atualiza no banco novo
        $this->legacyProdutoService->destroy($produtoLegacy->id); //apaga no banco velho
        $produto = parent::destroy($id); //apaga no banco novo

        return $produto;
    }

}