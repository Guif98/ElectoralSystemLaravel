<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;
use App\Models\Projeto;

class CategoriasControlador extends Controller
{
    protected $objCategoria;


    public function __construct()
    {
        $this->objCategoria = new Categorias();
        $this->objProjeto = new Projeto();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($projeto_id)
    {
        $projeto = $this->objProjeto->find($projeto_id);
        $categorias = Categorias::where('projeto_id', $projeto_id)->get();
        return view('layouts.categorias', compact('categorias', 'projeto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.criarCategoria');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->objCategoria->create([
            'nome' => $request->nome,
            'projeto_id' => $request->projeto_id
        ]);
        return redirect()->route('categorias', $request->projeto_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($projeto_id, $id)
    {
        $categoria = $this->objCategoria->find($id);
        return view('layouts.criarCategoria', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $projeto_id, $id)
    {
        $this->objCategoria->where(['id' => $id])->update([
            'nome' => $request->nome,
            'projeto_id' => $request->projeto_id
        ]);
        return redirect()->route('categorias', $projeto_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->objCategoria->destroy($id);
        return redirect()->back();
    }
}
