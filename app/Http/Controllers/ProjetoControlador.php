<?php

namespace App\Http\Controllers;


use App\Models\Projeto;
use App\Http\Requests\ProjetoRequest;
use App\Models\SubProjetos;
use App\Models\Categorias;
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
        $this->objProjeto->nome = $request->nome;
        $this->objProjeto->dataInicio = $request->dataInicio;
        $this->objProjeto->dataFim = $request->dataFim;
        $this->objProjeto->dataResultado = $request->dataResultado;

        $hoje = Date('Y-m-d', strtotime(today()));

        if ($request->hasFile('capa')) {
            $capa = $request->file('capa');
            $filename = time() . '__' . $capa->getClientOriginalExtension();
            $capa->move('storage/app/fotos', $filename);
            $this->objProjeto->capa = $filename;
        }

       // dd($this->objProjeto->dataInicio);

        if ($this->objProjeto->where('ativo', '1')->count() == 0) {
            if ($this->objProjeto->dataInicio < $hoje) {
                return redirect()->route('projetos')->with(['message' => 'Não é possível criar um projeto para uma data passada!', 'msg-type' => 'danger']);
            }
            else if ($request->dataInicio == $hoje && $request->dataFim >= $hoje) {
                $this->objProjeto->ativo = 1;
                $this->objProjeto->save();
                return redirect()->route('projetos')->with(['message' => 'Projeto criado com sucesso!', 'msg-type' => 'success']);
            }
            else if ($request->dataInicio > $hoje && $request->dataFim > $hoje) {
                $this->objProjeto->ativo = 0;
                $this->objProjeto->save();
                return redirect()->route('projetos')->with(['message' => 'Projeto criado com sucesso, o projeto será ativado em sua data de início!', 'msg-type' => 'success']);
            }
        } else {
            if ($this->objProjeto->dataInicio < $hoje) {
                return redirect()->route('projetos')->with(['message' => 'Não é possível criar um projeto para uma data passada!', 'msg-type' => 'danger']);
            }
            else if ($request->dataInicio == $hoje && $request->dataFim >= $hoje) {
                return redirect()->route('projetos')->with(['message' => 'Já há um projeto ativo para esta data!', 'msg-type' => 'danger']);
            }
            else if ($request->dataInicio > $hoje && $request->dataFim > $hoje) {
                $this->objProjeto->ativo = 0;
                $this->objProjeto->save();
                return redirect()->route('projetos')->with(['message' => 'Projeto criado com sucesso, o projeto será ativado em sua data de início!', 'msg-type' => 'success']);
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

        $hoje = Date('Y-m-d', strtotime(today()));
        $projetoAtivo = Projeto::where('ativo', 1)->get();


        if ($projeto->ativo == 1 && $projeto->dataInicio != $request->dataInicio) {
            return redirect()->route('projetos')->with(['message' => 'Não é possível alterar a data de início de um projeto ativo', 'msg-type' => 'danger']);
        }
        else if ($projeto->ativo == 0 &&  $projeto->dataInicio < $hoje){
            return redirect()->route('projetos')->with(['message' => 'Não é possível alterar um projeto passado', 'msg-type' => 'danger']);
        }
        else if ($projeto->ativo == 0 && $request->dataInicio > $hoje && $request->dataInicio >= $projetoAtivo->first()->dataInicio && $request->dataInicio <= $projetoAtivo->first()->dataFim) {
            $projeto->dataInicio = $request->dataInicio;
            $projeto->dataFim = $request->dataFim;
        }
        else if ($projeto->ativo == 0 && $request->dataInicio < $hoje) {
            return redirect()->route('projetos')->with(['message' => 'Não é possível alterar a data de início para uma data passada!', 'msg-type' => 'danger']);
        }
        else if ($projeto->ativo == 0 && $projeto->dataInicio > $hoje && $request->dataInicio == $hoje && isset($projetoAtivo) && $projetoAtivo->count() > 0) {
            return redirect()->route('projetos')->with(['message' => 'Não é possível alterar a data de início para a data atual, pois um projeto nessa data já se encontra ativo!', 'msg-type' => 'danger']);
        }


        if ($request->hasFile('capa')) {
            $capa = $request->file('capa');
            $filename = time() . '__' . $capa->getClientOriginalExtension();
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

        foreach ($projetoAtivo as $ativo) {
            if ($ativo->dataInicio > $hoje) {
                $projeto->ativo = 0;
                $projeto->desativado_permanentemente = 0;
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
