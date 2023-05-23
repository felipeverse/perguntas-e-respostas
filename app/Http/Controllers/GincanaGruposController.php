<?php

namespace App\Http\Controllers;

use App\Models\Gincana;
use App\Models\GincanaGrupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class GincanaGruposController extends Controller
{

    /**
     * Mostra o formulário de criação de um grupo vinculado aà uma gincana
     *
     * @return void
     */
    public function create(Gincana $gincana)
    {
        return view('gincanas.grupos.create', compact('gincana'));
    }

    /**
     * Salva um grupo vinculado à uma gincana
     *
     * @param Request $request
     * @param Gincana $gincana
     * @return void
     */
    public function store(Request $request, Gincana $gincana)
    {
        // Realiza validações
        $request->validate([
            'nome' => 'filled',
            'cor'  => 'filled',
        ]);

        $ordem = $gincana->grupos->count() + 1;

        GincanaGrupo::create([
            'ordem' => $ordem,
            'nome'  => $request->nome,
            'cor'   => $request->cor,
            'gincana_id' => $gincana->id
        ]);

        return redirect()->route('gincanas.edit', ['gincana' => $gincana->id]);
    }

    /**
     * Deleta uma gincana
     *
     * @param GincanaGrupo $gincanaGrupo
     * @return void
     */
    public function destroy(GincanaGrupo $gincanaGrupo)
    {
        $gincana = $gincanaGrupo->gincana;
        $gincanaGrupo->delete();

        // Reordena grupos
        $ordem = 1;
        foreach ($gincana->grupos->sortBy('ordem') as $grupo) {
            $grupo->update(['ordem' => $ordem++]);
        }

        return redirect()->route('gincanas.edit', ['gincana' => $gincana->id]);
    }
}
