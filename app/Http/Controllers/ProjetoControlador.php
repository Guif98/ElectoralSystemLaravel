<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Projeto;
use App\Http\Requests\ProjetoRequest;
use App\Models\SubProjetos;
use App\Models\Categorias;

class ProjetoControlador extends Controller
{


    private $objProjeto;
    private $objSubProjeto;
    private $objCategoria;

    public function __construct()
    {
        $this->middleware('auth');
        $this->objProjeto = new Projeto();
        $this->objSubProjeto = new SubProjetos();
        $this->objCategoria = new Categorias();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projetos = $this->objProjeto->all();
        return view('layouts.projetos', compact('projetos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projetos = $this->objProjeto->all();
        return view('layouts.novoProjeto', compact('projetos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjetoRequest $request)
    {
        $this->objProjeto->nome = $request->nome;
        $this->objProjeto->dataInicio = $request->dataInicio;
        $this->objProjeto->dataFim = $request->dataFim;
        if (is_null($request->ativo)) {
            $this->objProjeto->ativo = 0;
        }
        else {
            $this->objProjeto->ativo = implode("", $request->ativo);
        }
        $this->objProjeto->save();


        return redirect()->route('projetos')->with(['message' => 'Projeto criado com sucesso!', 'msg-type' => 'success']);

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
    public function edit($id)
    {
        $projeto = $this->objProjeto->find($id);
        return view('layouts.novoProjeto', compact('projeto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjetoRequest $request, $id)
    {
        $this->objProjeto->where(['id'=>$id])->update([
            'nome'=>$request->nome,
            'dataInicio'=>$request->dataInicio,
            'dataFim'=>$request->dataFim,
            'ativo'=> implode("", $request->ativo),
        ]);

        return redirect()->route('projetos')->with(['message' => 'Projeto atualizado com sucesso', 'msg-type' => 'warning']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->objProjeto->where(['id'=>$id])->delete();
        return redirect()->route('projetos')->with(['message' => 'Projeto excluído com sucesso', 'msg-type' => 'danger']);
    }

}
