<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Projeto;
use App\Http\Requests\ProjetoRequest;
use App\Models\SubProjetos;
use App\Models\Categorias;
use DateTime;
use Illuminate\Support\Facades\Date;

use function PHPUnit\Framework\isNull;

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

        if ($request->hasFile('capa')) {
            $capa = $request->file('capa');
            $filename = time() . '__' . $capa->getClientOriginalExtension();
            $capa->move('storage/app/fotos', $filename);
            $this->objProjeto->capa = $filename;
        }


        if ($this->objProjeto->where('ativo', '1')->count() == 0) {
            if ($request->dataInicio <= Date(now()) && $request->dataFim >= Date(now())) {
                $this->objProjeto->ativo = 1;
                $this->objProjeto->save();
                return redirect()->route('projetos')->with(['message' => 'Projeto criado com sucesso!', 'msg-type' => 'success']);
            }
        }

        $projetoAtivo = Projeto::where('ativo' , '1')->first();

        if ($request->dataInicio <= Date(now()) && $request->dataFim >= Date(now())) {
               if ($request->dataInicio >= $projetoAtivo->dataInicio && $request->dataInicio <= $projetoAtivo->dataFim) {
                    return redirect()->route('projetos')->with(['message' => 'Não foi possível criar o evento, um evento já está em andamento!', 'msg-type' => 'danger']);
               }
               else if ($request->dataFim >= $projetoAtivo->dataInicio && $request->dataFim <= $projetoAtivo->dataFim) {
                    return redirect()->route('projetos')->with(['message' => 'Não foi possível criar o evento, um evento já está em andamento!', 'msg-type' => 'danger']);
               }
               else {
                    $this->objProjeto->ativo = 1;
                    $this->objProjeto->save();
                    return redirect()->route('projetos')->with(['message' => 'Projeto criado com sucesso!', 'msg-type' => 'success']);
            }
        } else {
            return redirect()->route('projetos')->with(['message' => 'Não foi possível criar o evento, um evento já foi criado para o mesmo período!', 'msg-type' => 'danger']);
        }
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

        $projeto = $this->objProjeto->where(['id'=>$id])->first();
        $projeto->nome = $request->nome;
        $projeto->dataInicio = $request->dataInicio;
        $projeto->dataFim = $request->dataFim;

        if ($request->hasFile('capa')) {
            $capa = $request->file('capa');
            $filename = time() . '__' . $capa->getClientOriginalExtension();
            $capa->move('storage/app/fotos', $filename);
            $projeto->capa = $filename;
        }

        if ($projeto->dataInicio <= Date(now()) && $projeto->dataFim >= Date(now())) {
            $projeto->ativo = 1;
        } else {
            $projeto->ativo = 0;
        }

        if ($request->desativar == 1) {
            $projeto->ativo = 0;
        }

        $projeto->save();

        return redirect()->route('projetos')->with(['message' => 'Projeto atualizado com sucesso', 'msg-type' => 'warning']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /* public function destroy($id)
    {
        $this->objProjeto->where(['id'=>$id])->delete();
        return redirect()->route('projetos')->with(['message' => 'Projeto excluído com sucesso', 'msg-type' => 'danger']);
    }*/

}
