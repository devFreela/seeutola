<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Agenda::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'imagem' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $agenda = new Agenda;
        $agenda->titulo = $request->titulo;
        $agenda->descricao = $request->descricao;
        $agenda->link_youtube = $request->link_youtube;
        $agenda->dt_podcast = $request->dt_podcast;

        if ($request->file('imagem')){
            $agenda->imagem = date('YmdHis') . "." . $request->file('imagem')->getClientOriginalExtension();;
            $request->file('imagem')->move('assets/img/convidados', $agenda->imagem);
        }
        $agenda->save();
        return $agenda;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function show(Agenda $agenda)
    {
        return $agenda;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agenda $agenda)
    {
        $agenda->titulo = $request->titulo;
        $agenda->descricao = $request->descricao;
        $agenda->link_youtube = $request->link_youtube;
        $agenda->dt_podcast = $request->dt_podcast;
        if ($request->file('imagem')){
            $agenda->imagem = date('YmdHis') . "." . $request->file('imagem')->getClientOriginalExtension();;
            $request->file('imagem')->move('assets/img/convidados', $agenda->imagem);
        }
        /*if (!empty($request->imagem))
          $agenda->imagem = $request->imagem;*/

        $agenda->save();
        return $agenda;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return $agenda;
    }
}
