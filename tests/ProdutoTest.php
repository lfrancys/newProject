<?php


use App\Entities\Categoria;
use App\Entities\Produto;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Storage;

class ProdutoTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    /*public function testIndex()
    {
        $categorias = App\Entities\Categoria::all();

        $produto = App\Entities\Produto::create(array(
            'nome'      => str_random('8'),
            'preco'     => rand(100.00, 1000.00),
            'descricao' => str_random(60),
            'idCategoria' => $categorias[rand(0, (count($categorias)-1))]->id
        ));


        $response = $this->get(route('produtos.index'));
        $this->assertEquals(200, $response->response->getStatusCode());
        $this->seeJson(['nome' => $produto->nome]);

    }

    public function testStore(){

        $categorias = Categoria::all();

        $caminhofoto = public_path().'/imagens/';
        $nomeFoto = str_random(8).'.jpg';
        $uploadFoto = \Mockery::mock(\Illuminate\Http\UploadedFile::class, ['getClientOriginalName' => 'arquivoFake.jpg', 'getExtension' => 'jpg']);

        $produto = array(
            'nome'      => str_random('8'),
            'preco'     => rand(100.00, 1000.00),
            'descricao' => str_random(60),
            'foto'      => $caminhofoto.$nomeFoto,
            'idCategoria' => $categorias[rand(0, (count($categorias)-1))]->id
        );

        Storage::shouldReceive('put');
        $response = $this->call('POST', route('produtos.store'), $produto, [], ['files' => $uploadFoto]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->seeInDatabase('produtos', $produto);
    }*/

    public function testUpdate(){
        $categorias = Categoria::all();

        $produto = Produto::create(array(
            'nome'      => str_random('8'),
            'preco'     => rand(100.00, 1000.00),
            'descricao' => str_random(60),
            'idCategoria' => $categorias[rand(0, (count($categorias)-1))]->id
        ));

        //Inserir no banco velho
        \App\Legacy\Entities\Produto::create(array(
            'nome'      => $produto->nome,
            'preco'     => $produto->preco,
            'descricao' => $produto->descricao,
            'idCategoria' => $produto->idCategoria,
            'idProduto' => $produto->id
        ));

        $produtoAtualizado = array(
            'nome'      => 'Atualizado - '.$produto->nome
        );

        $response = $this->call('PUT', route('produtos.update', $produto->id), $produtoAtualizado);

        //print_r($response);

        $this->assertEquals(200, $response->getStatusCode());
        $this->seeInDatabase('produtos', ['nome' => $produtoAtualizado['nome']]);
    }

    public function testDelete(){
        $categorias = Categoria::all();

        $produto = Produto::create(array(
            'nome'      => str_random('8'),
            'preco'     => rand(100.00, 1000.00),
            'descricao' => str_random(60),
            'idCategoria' => $categorias[rand(0, (count($categorias)-1))]->id
        ));

        //Inserir no banco velho
        \App\Legacy\Entities\Produto::create(array(
            'nome'      => $produto->nome,
            'preco'     => $produto->preco,
            'descricao' => $produto->descricao,
            'idCategoria' => $produto->idCategoria,
            'idProduto' => $produto->id
        ));

        $response = $this->call('DELETE', route('produtos.destroy', $produto->id));

        $this->assertEquals(200, $response->getStatusCode());
        $this->notSeeInDatabase('produtos', ['id' => $produto->id]);
    }
}
