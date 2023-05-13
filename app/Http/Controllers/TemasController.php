<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use Illuminate\Http\Request;

class TemasController extends Controller
{
    /**
     * Lista os temas cadastrados
     *
     * @return void
     */
    public function index()
    {
        $temas = Tema::all();

        return view('temas.index', compact('temas'));
    }

    /**
     * Mostra os detalhes do tema
     *
     * @param  \App\Models\Tema $tema
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Tema $tema)
    {
         return view('temas.show', compact('tema'));
    }

    /**
     * Mostra o formulário de criação de um novo tema
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('temas.create');
    }

    /**
     * Mostra o formulário de edição do tema
     *
     * @param  \App\Models\Tema  $tema
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Tema $tema)
    {
        return view('temas.edit', compact('tema'));
    }

    /**
     * Salvar um novo tema
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'filled|max:150',
        ]);

        Tema::create([
            'titulo' => $request->titulo,
        ]);

        return redirect()->route('temas.index')->with('success', 'Tema criado com sucesso!');
    }

    /**
     * Atualiza um tema
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tema  $tema

     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tema $tema)
    {
        $request->validate([
            'titulo' => 'filled|max:150',
        ]);

        $tema->update([
            'titulo' => $request->titulo,
        ]);

        return redirect()->route('temas.index')->with('success', 'Tema atualizado com sucesso!');
    }

    /**
     * Excluir um tema
     *
     * @param  \App\Models\Tema  $tema
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tema $tema)
    {
        $tema->delete();

        return redirect()->route('temas.index')
            ->with('success', 'Tema excluído com sucesso!');
    }
}