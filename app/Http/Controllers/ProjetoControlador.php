<?php

namespace App\Http\Controllers;


use App\Models\Projeto;
use App\Http\Requests\ProjetoRequest;
use App\Models\SubProjetos;
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
        $projetoAtivo = $this->objProjeto->where('ativo', '1')->first();


        $dataInicio = Carbon::createFromFormat('Y-m-d', $projeto->dataInicio)->startOfDay()->toDateTimeString();
        $dataFim = Carbon::createFromFormat('Y-m-d', $projeto->dataFim)->endOfDay()->toDateTimeString();
        $hoje = Carbon::createFromTimeString(Date(today()))->toDateTimeString();
        $dataResultadoProjetoAtivo = Carbon::createFromFormat('Y-m-d', $projetoAtivo->dataResultado)->startOfDay()->toDateTimeString();

        if ($request->hasFile('capa')) {
            $capa = $request->file('capa');
            $filename = time() . '__' . $capa->getClientOriginalName();
            $capa->move('storage/app/fotos', $filename);
            $this->objProjeto->capa = $filename;
        }

       // dd($this->objProjeto->dataInicio);

        if ($this->objProjeto->where('ativo', '1')->count() == 0) {
            if ($dataInicio < $hoje) {
                return redirect()->route('projetos')->with(['message' => 'Não é possível criar um projeto para uma data passada!', 'msg-type' => 'danger']);
            }
            else if ($dataInicio == $hoje && $dataFim >= $hoje) {
                $this->objProjeto->ativo = 1;
                $this->objProjeto->save();
                return redirect()->route('projetos')->with(['message' => 'Projeto criado com sucesso!', 'msg-type' => 'success']);
            }
            else if ($dataInicio > $hoje) {
                $this->objProjeto->ativo = 0;
                $this->objProjeto->save();
                return redirect()->route('projetos')->with(['message' => 'Projeto criado com sucesso, o projeto será ativado em sua data de início!', 'msg-type' => 'success']);
            }
        } else {
            if ($dataInicio < $hoje) {
                return redirect()->route('projetos')->with(['message' => 'Não é possível criar um projeto para uma data passada!', 'msg-type' => 'danger']);
            }
            else if ($dataInicio == $hoje && $dataFim >= $hoje) {
                return redirect()->route('projetos')->with(['message' => 'Já há um projeto ativo para esta data!', 'msg-type' => 'danger']);
            }
            else if ($dataInicio > $dataResultadoProjetoAtivo) {
                $this->objProjeto->ativo = 0;
                $this->objProjeto->save();
                return redirect()->route('projetos')->with(['message' => 'Projeto criado com sucesso, o projeto será ativado em sua data de início!', 'msg-type' => 'success']);
            }
            else if ($dataInicio > $hoje && $dataInicio < $dataResultadoProjetoAtivo){
                return redirect()->route('projetos')->with(['message' => 'Não foi possível criar o projeto pois a data de início deve ser superior a data do resultado do projeto já ativado', 'msg-type' => 'danger']);
            }
        }
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
        $projeto = $this->objProjeto->where(['id'=>$id])->first();
        $projeto->nome = $request->nome;
        $projeto->dataInicio = $request->dataInicio;
        $projeto->dataFim = $request->dataFim;
        $projeto->dataResultado = $request->dataResultado;

        $dataInicio = Carbon::createFromFormat('Y-m-d', $projeto->dataInicio)->startOfDay()->toDateTimeString();
        $dataFim = Carbon::createFromFormat('Y-m-d', $projeto->dataFim)->endOfDay()->toDateTimeString();
        $hoje = Carbon::createFromTimeString(Date(today()))->toDateTimeString();

        $projetoAtivo = Projeto::where('ativo', 1)->first();

        $dataInicioProjetoAtivo = Carbon::createFromFormat('Y-m-d', $projetoAtivo->dataInicio)->startOfDay()->toDateTimeString();
        $dataFimProjetoAtivo = Carbon::createFromFormat('Y-m-d', $projetoAtivo->dataFim)->endOfDay()->toDateTimeString();


        if ($projeto->ativo == 0 && $dataInicio > $hoje && $dataInicio >= $projetoAtivo->dataInicio && $dataInicio <= $projetoAtivo->first()->dataFim) {
            return redirect()->route('projetos')->with(['message' => 'Um projeto já está em andamento para esta data', 'msg-type' => 'danger']);
        }
        else if ($projeto->ativo == 0 && $dataInicio > $hoje) {
            $projeto->ativo = 0;
        }
        else if ($projeto->ativo == 1 && $dataFim < $hoje || $dataInicio > $hoje) {
            $projeto->ativo = 0;
        }
        else if ($projeto->ativo == 0 && $projeto->desativado_permanentemente == 0 && $dataInicio <= $dataInicioProjetoAtivo && $dataFim >= $dataFimProjetoAtivo) {
            $projeto->ativo = 0;
            $projeto->save();
            return redirect()->route('projetos')->with(['message' => 'Um evento já está em andamento entre esta data.', 'msg-type' => 'danger']);
        }
        else if ($projeto->ativo == 0 && $projeto->desativado_permanentemente == 0 && $dataInicio <= $dataInicioProjetoAtivo && $dataFim <= $dataFimProjetoAtivo) {
            $projeto->ativo = 0;
            $projeto->save();
            return redirect()->route('projetos')->with(['message' => 'Não é possível criar o evento, pois o evento já ativo acontece neste período.', 'msg-type' => 'danger']);
        }
        else if ($projeto->ativo == 0 && $projeto->desativado_permanentemente == 0 && $dataInicio >= $dataInicioProjetoAtivo && $dataInicio <= $dataFimProjetoAtivo && $dataFim > $dataFimProjetoAtivo) {
            $projeto->ativo = 0;
            $projeto->save();
            return redirect()->route('projetos')->with(['message' => 'Não é possível criar o evento, pois o evento já ativo acontece neste período.', 'msg-type' => 'danger']);
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

        /*if ($projeto->ativo == 1 && $projeto->dataFim < $hoje) {
            $projeto->ativo = 0;
        } else if ($projeto->ativo == 1  && $projeto->dataInicio > $hoje) {
            $projeto->ativo = 0;
        } else if ($projeto->ativo == 1 && $projeto->dataInicio <= $hoje &&  $projeto->dataFim >= $hoje) {
            $projeto->ativo = 1;
        }  else if ($projeto->ativo == 0 && $projeto->dataInicio <= $hoje &&  $projeto->dataFim >= $hoje) {
            $projeto->ativo = 1;
        }*/


        /*foreach ($projetos as $p) {
            if ($projeto->dataInicio >= $p->dataInicio && $p->dataFim >= $projeto->dataInicio && $p != $projeto) {
                return redirect()->route('projetos')->with(['message' => 'Já existe um projeto para o mesmo período', 'msg-type' => 'danger']);
            }
            else if ($projeto->dataInicio <= $p->dataInicio && $projeto->dataFim >= $p->dataInicio && $p != $projeto) {
                return redirect()->route('projetos')->with(['message' => 'Já existe um projeto para o mesmo período', 'msg-type' => 'danger']);
            }
            else if ($projeto->dataInicio >= $p->dataInicio && $projeto->dataInicio <= $p->dataFim && $p != $projeto) {
                return redirect()->route('projetos')->with(['message' => 'Já existe um projeto para o mesmo período', 'msg-type' => 'danger']);
            }
            else if ($p->dataInicio <= $projeto->dataInicio && $p->dataInicio <= $projeto->dataFim  && $p != $projeto) {
                return redirect()->route('projetos')->with(['message' => 'Já existe um projeto para o mesmo período', 'msg-type' => 'danger']);
            } else {
                $projeto->save();
                return redirect()->route('projetos')->with(['message' => 'Projeto atualizado com sucesso!', 'msg-type' => 'warning']);
            }
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
        $this->objProjeto->where(['id'=>$id])->delete();
        return redirect()->route('projetos')->with(['message' => 'Projeto excluído com sucesso', 'msg-type' => 'danger']);
    }

}
