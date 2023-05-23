<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use App\Models\Nivel;
use App\Models\Gincana;
use App\Models\Pergunta;
use App\Models\GincanaFase;
use App\Models\GincanaGrupo;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use function GuzzleHttp\Promise\all;

class GincanaFasesController extends Controller
{

    /**
     * Mostra o formulário de criação de uma fase vinculado aà uma gincana
     *
     * @return void
     */
    public function create(Gincana $gincana)
    {
        // Busca níveis para serem usados no select da pergunta
        $niveis = Nivel::all();

        $temas = Tema::all();

        // Busca os tipos de perguntas para serem usados no select da perguntas
        $tipos = Pergunta::TIPOS;

        return view('gincanas.fases.create', compact('gincana', 'niveis', 'temas', 'tipos'));
    }

    /**
     * Salva uma fase vinculado à uma gincana
     *
     * @param Request $request
     * @param Gincana $gincana
     *
     * @return void
     */
    public function store(Request $request, Gincana $gincana)
    {
        // Realiza validações
        $request->validate([
            'nivel' => 'required',
            'temas'  => 'required|array',
            'tipo_pergunta'  => [
                'required',
                Rule::in(Pergunta::TIPOS),
            ],
            'pontuacao_erro'  => 'required|min:0|max:100',
            'pontuacao_parcial'  => 'required|min:0|max:100',
            'pontuacao_acerto'  => 'required|min:0|max:100',
            'perguntas_por_grupo'  => 'required|min:1',
            'selecionar_tema_manualmente'  => 'sometimes',
        ]);

        $ordem = $gincana->fases->count() + 1;

        $gincanaFase = new GincanaFase([
            'gincana_id' => $gincana->id,
            'nivel_id' => $request->nivel,
            'ordem' => $ordem,
            'tipo_pergunta' => $request->tipo,
            'pontuacao_erro' => $request->pontuacao_erro,
            'pontuacao_parcial' => $request->pontuacao_parcial,
            'pontuacao_acerto' => $request->pontuacao_acerto,
            'perguntas_por_grupo' => $request->perguntas_por_grupo,
            'selecionar_tema_manualmente' => isset($request->selecionar_tema_manualmente) ? true : false,
        ]);

        $gincanaFase->save();
        $gincanaFase->temas()->attach($request->temas);

        return redirect()->route('gincanas.edit', ['gincana' => $gincana->id]);
    }

    /**
     * Deleta uma fase
     *
     * @param GincanaGrupo $gincanaGrupo
     * @return void
     */
    public function destroy(GincanaFase $gincanaFase)
    {
        $gincana = $gincanaFase->gincana;
        $gincanaFase->delete();

        // Reordena fases
        $ordem = 1;
        foreach ($gincana->fases->sortBy('ordem') as $fase) {
            $fase->update(['ordem' => $ordem++]);
        }

        return redirect()->route('gincanas.edit', ['gincana' => $gincana->id]);
    }
}
