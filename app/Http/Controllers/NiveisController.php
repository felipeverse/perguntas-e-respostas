<?php

namespace App\Http\Controllers;

use App\Models\Nivel;
use Illuminate\Http\Request;

class NiveisController extends Controller
{
    /**
     * Lista os niveis cadastrados
     *
     * @return void
     */
    public function index()
    {
        $niveis = Nivel::all();

        return view('niveis.index', compact('niveis'));
    }

    /**
     * Mostra o formulário de criação de um novo nível
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('niveis.create');
    }

    /**
     * Salvar um novo nível
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

        Nivel::create([
            'titulo' => $request->titulo,
        ]);

        return redirect()->route('niveis.index')->with('success', 'Nível criado com sucesso!');
    }

    /**
     * Mostra o formulário de edição do Nível
     *
     * @param  \App\Models\Tema  $tema
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Nivel $nivel)
    {
        return view('niveis.edit', compact('nivel'));
    }

    /**
     * Mostra os detalhes do Nível
     *
     * @param  \App\Models\Nivel $nivel
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Nivel $nivel)
    {
        return view('niveis.show', compact('nivel'));
    }

    /**
     * Atualiza um nível
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nivel  $nivel

     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nivel $nivel)
    {
        $request->validate([
            'titulo' => 'filled|max:150',
        ]);

        $nivel->update([
            'titulo' => $request->titulo,
        ]);

        return redirect()->route('niveis.index')->with('success', 'Tema atualizado com sucesso!');
    }

    /**
     * Excluir um nível
     *
     * @param  \App\Models\Nivel  $nivel
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nivel $nivel)
    {
        if ($nivel->perguntas()->count()) {
            return redirect()->route('temas.index')
                ->withErrors(['erro' => 'Exclusão não permitida: tema vinculado à perguntas.']);
        }

        $nivel->delete();

        return redirect()->route('niveis.index')
            ->with('success', 'Nível excluído com sucesso!');
    }
}
