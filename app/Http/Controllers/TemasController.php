<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use App\Models\Nivel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

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
     * Mostra o formulário de criação de um novo tema
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('temas.create');
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
        if ($tema->perguntas()->count()) {
            return redirect()->route('temas.index')
                ->withErrors(['erro' => 'Exclusão não permitida: tema vinculado à perguntas.']);
        }

        $tema->delete();

        return redirect()->route('temas.index')
            ->with('success', 'Tema excluído com sucesso!');
    }

    public function temasPartialView(Nivel $nivel)
    {
        try {
            DB::beginTransaction();

            $temas = Tema::whereIn('id', $nivel->perguntas->pluck('tema_id')->toArray())->get();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            $errorMessage = 'Erro na chamada ajax.';
            return response()->json(['error' => $errorMessage], Response::HTTP_BAD_REQUEST);
        }

        return view('gincanas.fases.partials.temas', compact('temas'));
    }
}
