<?php

namespace App\Http\Controllers;

use App\Models\Gincana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GincanasController extends Controller
{
    /**
     * Lista as gincanas cadastradas
     *
     * @return void
     */
    public function index()
    {
        try {
            $gincanas = Gincana::all();
        } catch (\Throwable $th) {
            return back()->withErrors(['message' => $th->getMessage()]);
        }

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
        try {
            DB::beginTransaction();

            // Validações
            $request->validate([
                'titulo'    => 'filled',
                'descricao' => 'filled',
            ]);

            Gincana::create([
                'titulo'    => $request->titulo,
                'descricao' => $request->descricao,
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors(['message' => $th->getMessage()]);
        }

        return redirect()->route('gincanas.index')->with('success', 'Gincana criada com sucesso');
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
        try {
            DB::beginTransaction();

            // Validações
            $request->validate([
                'titulo'    => 'filled',
                'descricao' => 'filled',
            ]);

            $gincana->update([
                'titulo'    => $request->titulo,
                'descricao' => $request->descricao,
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors(['message' => $th->getMessage()]);
        }

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
        try {
            DB::beginTransaction();

            $gincana->delete();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors(['message' => $th->getMessage()]);
        }

        return redirect()->route('gincanas.index')
            ->with('success', 'Gincana excluída com sucesso!');
    }
}
