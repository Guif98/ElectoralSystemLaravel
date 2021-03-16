<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VotoRequest;
use App\Models\Categorias;
use App\Models\Foto;
use App\Models\SubProjetos;
use App\Models\Projeto;
use App\Models\Voto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Cache\RedisTaggedCache;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class SubProjetoControlador extends Controller
{

    private $objCategoria;
    private $objSubProjeto;
    private $objProjeto;
    private $objFoto;
    private $objVoto;

    public function __construct()
    {
        $this->objSubProjeto = new SubProjetos();
        $this->objCategoria = new Categorias();
        $this->objProjeto = new Projeto();
        $this->objFoto = new Foto();
        $this->objVoto = new Voto();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($projeto_id)
    {
        $subProjetos = SubProjetos::where('projeto_id', $projeto_id)->get();
        $categorias = $this->objCategoria->all();
        return view('layouts.subprojetos', compact('categorias','subProjetos'));
    }

    public function home()
    {
        $projetos = $this->objProjeto->where('ativo', 1)->get();
        $subProjetos = $this->objSubProjeto->all();
        $categorias = $this->objCategoria->all();
        $fotos = $this->objFoto->all();
        return view('home', compact('projetos','subProjetos', 'categorias', 'fotos'));
    }

    public function votar(VotoRequest $request) {
        $novoVoto = new Voto();
        $novoVoto->nome = $request->nome;
        $novoVoto->sobrenome = $request->sobrenome;
        $novoVoto->cpf = $request->cpf;

        foreach ($request->voto as $v) {

            $novoVoto->subProjeto_id = $v;
            $novoVoto->save();
        }


        return redirect()->back()->with(['message' => 'Voto computado com sucesso', 'msg-type' => 'success']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($projeto_id)
    {
        $subProjetos = $this->objSubProjeto->all();


        $categorias = Categorias::where('projeto_id', $projeto_id)->get();

        return view('layouts.formProjeto', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->objSubProjeto->titulo = $request->titulo;
        $this->objSubProjeto->projeto_id = $request->projeto_id;
        $this->objSubProjeto->categoria_id = $request->categoria_id;
        $this->objSubProjeto->descricao = $request->descricao;
        $this->objSubProjeto->integrantes = $request->integrantes;
        $this->objSubProjeto->save();

            /**$file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('storage/app/fotos', $filename);
            $this->objSubProjeto->foto = $filename;**/

        return redirect()->route('subprojetos', $request->projeto_id)->with(['message' => 'Subprojeto criado com sucesso!', 'msg-type' => 'success']);
    }

    public function fotos($projeto_id, $id) {
        $subProjeto = $this->objSubProjeto->find($id);
        return view('layouts.foto', compact('subProjeto'));
    }

    public function storeFoto(Request $request,$projeto_id, $id) {
          /*  $objFoto = new Foto();
            $arrayFotos = [];
            if ($request->hasFile('foto')) {
                foreach ($request->foto as $fotos) {
                    $filename = $fotos->getClientOriginalName();
                    $fotos->move('storage/app/fotos', $filename);
                    $arrayFotos[] = ['filename' => $filename, 'subprojeto_id' => $id];

                    $objFoto->foto = $filename;
                    $objFoto->subprojeto_id = $id;
                    if (Foto::where('subprojeto_id', $id)->count() < 4){
                        $objFoto->save();
                    }
                    else {
                        return redirect()->route('addFoto', [$projeto_id, $id])->with(['message' => 'O limite de imagens para cada projeto
                        é de quatro imagens!', 'msg-type' => 'danger']);
                    }
            }
        }*/
        $fotos = $request->file('foto');
        //dd($fotos);
        if(!empty($fotos)):

            foreach($fotos as $foto):
                $filename = $id . '_' . time() . '_' . $foto->getCLientOriginalName();
                $foto->move('storage/app/fotos', $filename);

                $objFoto = new Foto([
                    'foto' => $filename,
                    'subprojeto_id' => $id
                ]);
                if (Foto::where('subprojeto_id', $id)->count() < 4){
                    $objFoto->save();
                }

                else {
                    return redirect()->route('addFoto', [$projeto_id, $id])->with(['message' => 'O limite de imagens para cada projeto
                    é de 4 imagens!', 'msg-type' => 'danger']);
                }

            endforeach;
        endif;

        if (!isset($fotos)){
            return redirect()->route('addFoto', [$projeto_id, $id])->with(['message' => 'Deve ser selecionado no mínimo uma imagem!', 'msg-type' => 'danger']);
        } else {
            return redirect()->route('subprojetos', $projeto_id)->with(['message' => 'Imagem inserida com sucesso!', 'msg-type' => 'success']);

        }
    }


    public function deletarFoto($projeto_id, $img) {
        $this->objFoto->destroy($img);
        return redirect()->back()->with(['message' => 'Imagem excluída com sucesso!', 'msg-type' => 'danger']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($projeto_id, $id)
    {
        $subProjeto = $this->objSubProjeto->find($id);
        $projetos = $this->objProjeto->all();
        return view('layouts.ver', compact('subProjeto', 'projetos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($projeto_id, $id)
    {
        $subProjeto = $this->objSubProjeto->find($id);
        $categorias = Categorias::where('projeto_id', $projeto_id)->get();
        return view('layouts.formProjeto', compact('subProjeto', 'categorias'));
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
        $subProjeto = $this->objSubProjeto->find($id);
        $subProjeto->titulo = $request->titulo;
        $subProjeto->projeto_id = $request->projeto_id;
        $subProjeto->categoria_id = $request->categoria_id;
        $subProjeto->descricao = $request->descricao;
        $subProjeto->integrantes = $request->integrantes;
        $subProjeto->save();

        return redirect()->route('subprojetos', $request->projeto_id)->with(['message' => 'Subprojeto atualizado com sucesso!', 'msg-type' => 'warning']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $this->objSubProjeto->destroy($id);
        return redirect()->back()->with(['message' => 'Subprojeto excluído com sucesso!', 'msg-type' => 'danger']);
    }
}
