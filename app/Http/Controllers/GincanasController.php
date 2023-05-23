<?php

namespace App\Http\Controllers;

use App\Models\Gincana;
use Illuminate\Http\Request;

class GincanasController extends Controller
{
    /**
     * Lista as gincanas cadastradas
     *
     * @return void
     */
    public function index()
    {
        $gincanas = Gincana::all();

        return view('gincanas.index', compact('gincanas'));
    }

    /**
     * Mostra o formulário de criação de uma nova gincana
     *
     * @return void
     */
    public function create()
    {
        return view('gincanas.create');
    }

    /**
     * Salvar uma nova gincana
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Realizar validações
        $request->validate([
            'titulo'    => 'filled',
            'descricao' => 'filled',
        ]);

        Gincana::create([
            'titulo'    => $request->titulo,
            'descricao' => $request->descricao,
        ]);

        return redirect()->route('gincanas.index')->with('success', 'Nível criado com sucesso');
    }

    /**
     * Mostra o formulário de edição de pergunta
     *
     * @param Gincana $gincana
     *
     * @return Response
     */
    public function edit(Gincana $gincana)
    {
        return view('gincanas.edit', compact('gincana'));
    }

    /**
     * Atualiza uma gincana
     *
     * @param Request $request
     * @param Gincana $gincana
     * @return void
     */
    public function update(Request $request, Gincana $gincana)
    {
        // Realizar validações
        $request->validate([
            'titulo'    => 'filled',
            'descricao' => 'filled',
        ]);

        $gincana->update([
            'titulo'    => $request->titulo,
            'descricao' => $request->descricao,
        ]);

        return redirect()->route('gincanas.index')->with('success', 'Gincana atualizada com sucesso!');
    }

    /**
     * Excluir uma gincana
     *
     * @param Gincana $gincana
     *
     * @return Response
     */
    public function destroy(Gincana $gincana)
    {
        $gincana->delete();

        return redirect()->route('gincanas.index')
            ->with('success', 'Gincana excluída com sucesso!');
    }
}
