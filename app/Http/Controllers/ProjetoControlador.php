<?php

namespace App\Http\Controllers;


use App\Models\Projeto;
use App\Http\Requests\ProjetoRequest;
use App\Models\SubProjetos;
use App\Models\Foto;
use App\Models\Categorias;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;



class ProjetoControlador extends Controller
{


    private $objProjeto;


    public function __construct()
    {
        $this->objProjeto = new Projeto();
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
        $projeto = $this->objProjeto;
        $projeto->nome = $request->nome;
        $projeto->dataInicio = $request->dataInicio;
        $projeto->dataFim = $request->dataFim;
        $projeto->dataResultado = $request->dataResultado;

        //Projeto que está ativado

        $dataInicio = Carbon::createFromFormat('Y-m-d', $projeto->dataInicio)->startOfDay()->toDateTimeString();
        $dataFim = Carbon::createFromFormat('Y-m-d', $projeto->dataFim)->endOfDay()->toDateTimeString();
        $hoje = Carbon::createFromTimeString(Date(today()))->toDateTimeString();
        if (isset($projetoAtivo) && $projetoAtivo != null) {
            $dataResultadoProjetoAtivo = Carbon::createFromFormat('Y-m-d', $projetoAtivo->dataResultado)->startOfDay()->toDateTimeString();
        }

        if ($request->hasFile('capa')) {
            $capa = $request->file('capa');
            $filename = time() . '__' . $capa->getClientOriginalName();
            $capa->move('storage/app/fotos', $filename);
            $this->objProjeto->capa = $filename;
        }

        if($dataInicio < $hoje || $dataFim < $hoje) {
            return redirect()->route('projetos')->with(['message' => 'Não é possível criar um projeto para uma data passada!', 'msg-type' => 'danger']);
        } else {
            $projeto->ativo = 1;
            $projeto->save();
            return redirect()->route('projetos')->with(['message' => 'Projeto criado com sucesso', 'msg_type' => 'success']);
        }

    }

    public function votacao($id) {
        $projeto = Projeto::find($id);
        $categorias = Categorias::where(['projeto_id' => $id, 'excluido' => 0])->get();
        $subProjetos = SubProjetos::where('projeto_id', $id)->get();
        $fotos = Foto::where('desativado', 0)->get();
        return view('votacao', compact(['projeto', 'categorias', 'subProjetos', 'fotos']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function resultado()
    {
        $projetos = Projeto::where('exibirResultado', 1)->get();
        return view('resultados', compact('projetos'));
    }

    public function resultadoView($id)
    {
        $projeto = $this->objProjeto->find($id);
        $categorias = Categorias::where('projeto_id', $id)->get();
        $subprojetos = SubProjetos::where('projeto_id', $id)->get();
        $maisVotados = DB::table('votos')->join('subProjetos', 'subProjetos.id', '=', 'votos.subProjeto_id')->join('projetos', 'projetos.id', '=', 'votos.projeto_id')->select('subProjeto_id', 'votos.categoria_id', 'titulo', 'votos.projeto_id as projeto_id', DB::raw('COUNT(subProjeto_id) as qtdVotos'))->groupBy('subProjeto_id', 'categoria_id',  'titulo', 'projeto_id')
        ->orderByRaw('COUNT(*) DESC')->limit(20)->get();
        return view('resultadoView', compact('projeto', 'categorias', 'maisVotados', 'subprojetos'));
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
        $projeto = $this->objProjeto->find($id);
        $projeto->nome = $request->nome;
        $projeto->dataInicio = $request->dataInicio;
        $projeto->dataFim = $request->dataFim;
        $projeto->dataResultado = $request->dataResultado;


        $dataInicio = Carbon::createFromFormat('Y-m-d', $projeto->dataInicio)->startOfDay()->toDateTimeString();
        $dataFim = Carbon::createFromFormat('Y-m-d', $projeto->dataFim)->endOfDay()->toDateTimeString();
        $hoje = Carbon::createFromTimeString(Date(today()))->toDateTimeString();

        if ($hoje >= $dataInicio && $hoje <= $dataFim) {
            $projeto->ativo = 1;
        } else {
            $projeto->ativo = 0;
        }

        if ($request->hasFile('capa')) {
            $capa = $request->file('capa');
            $filename = time() . '_' . $capa->getClientOriginalName();
            $capa->move('storage/app/fotos', $filename);
            $projeto->capa = $filename;
        }

        if (isset($request->desativar)) {
            if ($request->desativar[0] == '1') {
                $projeto->ativo = 0;
                $projeto->desativado_permanentemente = 1;
                $projeto->save();
                return redirect()->route('projetos')->with(['message' => 'Projeto desativado com sucesso!', 'msg-type' => 'warning']);
            }
        }

        $projeto->save();
        return redirect()->route('projetos')->with(['message' => 'Atualizado com sucesso', 'msg-type' => 'warning']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $projeto = $this->objProjeto->find($id);
        $projeto->excluido = 1;
        $projeto->save();
        return redirect()->route('projetos')->with(['message' => 'Projeto excluído com sucesso', 'msg-type' => 'danger']);
    }

    public function desativarProjeto(ProjetoRequest $request) {
        dd($request->id);
        $projeto = $this->objProjeto->find($request->id);
        $projeto->ativo = 0;
        $projeto->desativado_permanentemente = 1;
    }

}
