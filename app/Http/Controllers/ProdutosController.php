<?php

namespace App\Http\Controllers;

use App\Services\CategoriaService;
use App\Services\ProdutosService;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProdutosController extends Controller
{
    /**
     * @var ProdutosService
     */
    protected $produtosService;
    protected $categoriaService;

    /**
     * @param ProdutosService $produtosService
     */
    function __construct(ProdutosService $produtosService, CategoriaService $categoriaService)
    {
        $this->produtosService = $produtosService;
        $this->categoriaService = $categoriaService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = $this->produtosService->all();

        return $produtos;
        //return view('content.Produtos.index')->with('produtos', $produtos);
    }


    public function create(Request $request)
    {
        /*$lstCategorias = $this->categoriaService->all();
        $categorias = array('-1' => 'Selecione');
        foreach($lstCategorias as $categoria){
            $categorias[$categoria->id] = $categoria->id;
        }*/

        //return view('content.Produtos.create.index')->with('categorias', $categorias);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //try{
            return $this->produtosService->create($request->all());
            /*    return redirect()->back()->with(['success' => 'ok']);
            }catch (\Exception $e){
                return redirect()->back()->withErrors(['error' => 'fALHA'])->withInput();
            }*/
    }

    public function edit($id){

        $lstCategorias = $this->categoriaService->all();
        $categorias = array('-1' => 'Selecione');
        foreach($lstCategorias as $categoria){
            $categorias[$categoria->id] = $categoria->id;
        }

        $produto = $this->produtosService->find(['id' => $id])->first();

        //return view('content.Produtos.edit.index')->with(['categorias' => $categorias, 'produto' => $produto]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //try{
            return $this->produtosService->update($request->all(), $id);
        /* }catch (\Exception $e){
             return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
         }*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //try{
            return $this->produtosService->destroy($id);
        /*}catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => 'Falha ao excluir'])->withInput();
        }*/
    }
}
