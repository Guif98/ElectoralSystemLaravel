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


    public function __construct()
    {
        $this->middleware('auth');
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
            } else {
                $projetos = Projeto::all();
                foreach ($projetos as $p) {
                    if ($this->objProjeto->dataInicio >= $p->dataInicio && $this->objProjeto->dataFim <= $p->dataFim) {
                        return redirect()->route('projetos')->with(['message' => 'Já existe um projeto para o mesmo período', 'msg-type' => 'danger']);
                    }
                    else if ($this->objProjeto->dataInicio <= $p->dataInicio && $this->objProjeto->dataFim >= $p->dataInicio && $this->objProjeto->dataFim <= $p->dataFim) {
                        return redirect()->route('projetos')->with(['message' => 'Já existe um projeto para o mesmo período', 'msg-type' => 'danger']);
                    }
                    else if ($this->objProjeto->dataInicio >= $p->dataInicio && $this->objProjeto->dataInicio <= $p->dataFim) {
                        return redirect()->route('projetos')->with(['message' => 'Já existe um projeto para o mesmo período', 'msg-type' => 'danger']);
                    }
                    else if ($this->objProjeto->dataInicio <= $p->dataInicio && $this->objProjeto->dataFim >= $p->dataInicio) {
                        return redirect()->route('projetos')->with(['message' => 'Já existe um projeto para o mesmo período', 'msg-type' => 'danger']);
                    }
                    else if ($this->objProjeto->dataInicio > $p->dataInicio) {
                        $this->objProjeto->ativo = 0;
                        $this->objProjeto->save();
                        return redirect()->route('projetos')->with(['message' => 'Projeto criado com sucesso, porém desativado por se tratar de um projeto futuro!', 'msg-type' => 'success']);
                    }
                    else {
                        $this->objProjeto->ativo = 1;
                        $this->objProjeto->save();
                        return redirect()->route('projetos')->with(['message' => 'Projeto criado com sucesso!', 'msg-type' => 'success']);
                    }
                }
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

        $projetos = Projeto::all();
        $projetoAtivo = Projeto::where('ativo' , '1')->first();


        if ($projetoAtivo->count() > 1) {
            return redirect()->route('projetos')->with(['message' => 'É necessário desativar o evento ativo para iniciar este evento', 'msg-type' => 'danger']);
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
                $projeto->save();
                return redirect()->route('projetos')->with(['message' => 'Projeto desativado com sucesso!', 'msg-type' => 'warning']);
            } else {
                $projeto->ativo = 1;
            }
        }

        if ($projeto->ativo == 1 && $projeto->dataFim < Date(now())) {
            $projeto->ativo = 0;
        } else if ($projeto->ativo == 1  && $projeto->dataInicio > Date(now())) {
            $projeto->ativo = 0;
        } else if ($projeto->ativo == 1 && $projeto->dataInicio <= Date(now()) &&  $projeto->dataFim >= Date(now())) {
            $projeto->ativo = 1;
        }

        foreach ($projetos as $p) {
            if ($projeto->dataInicio >= $p->dataInicio && $p->dataFim >= $projeto->dataFim && $p != $projetos->find($id)) {
                return redirect()->route('projetos')->with(['message' => 'Já existe um projeto para o mesmo período', 'msg-type' => 'danger']);
            }
            else if ($projeto->dataInicio <= $p->dataInicio && $projeto->dataFim >= $p->dataInicio && $projeto->dataFim <= $p->dataFim && $p != $projetos->find($id)) {
                return redirect()->route('projetos')->with(['message' => 'Já existe um projeto para o mesmo período', 'msg-type' => 'danger']);
            }
            else if ($projeto->dataInicio >= $p->dataInicio && $projeto->dataInicio <= $p->dataFim && $p != $projetos->find($id)) {
                return redirect()->route('projetos')->with(['message' => 'Já existe um projeto para o mesmo período', 'msg-type' => 'danger']);
            }
            else if ($p->dataInicio <= $projeto->dataInicio && $p->dataFim <= $projeto->dataFim) {
                return redirect()->route('projetos')->with(['message' => 'Já existe um projeto para o mesmo período', 'msg-type' => 'danger']);
            }
        }


        $projeto->save();
        return redirect()->route('projetos')->with(['message' => 'Projeto atualizado com sucesso!', 'msg-type' => 'warning']);
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
