<?php

namespace App\Http\Controllers;

use App\Models\Eleitor;
use Illuminate\Http\Request;

class EleitorControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $objEleitor;

    public function __construct()
    {
        $this->objEleitor = new Eleitor();
    }

    public function index()
    {
        $eleitores = $this->objEleitor->all();
        return view('formulario', compact('eleitores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->objEleitor->cpf = $request->cpf;
        $this->objEleitor->nascimento = $request->nascimento;
        $this->objEleitor->telefone = $request->telefone;
        $this->objEleitor->nome = $request->nome;
        $this->objEleitor->email = $request->email;
        $this->objEleitor->endereco = $request->endereco;
        $this->objEleitor->bairro = $request->bairro;
        $this->objEleitor->cidade = $request->cidade;
        $this->objEleitor->uf = $request->uf;
        $this->objEleitor->save();
        return redirect()->route('/');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
