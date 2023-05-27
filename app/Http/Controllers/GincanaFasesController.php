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
use Illuminate\Support\Facades\DB;

class GincanaFasesController extends Controller
{
    /**
     * Mostra o formulário de criação de uma fase vinculado aà uma gincana
     *
     * @return void
     */
    public function create(Gincana $gincana)
    {
        try {
            // Busca itens que serão usados no form
            $niveis = Nivel::all();
            $temas = Tema::all();
            $tipos = Pergunta::TIPOS;
        } catch (\Throwable $th) {
            return back()->withErrors(['Exception:' => $th->getMessage()]);
        }

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
        try {
            DB::beginTransaction();

            // Realiza validações
            $request->validate([
                'nivel' => 'required',
                'tipo'  => [
                    'required',
                    Rule::in(Pergunta::TIPOS),
                ],
                'temas'                       => 'required|array',
                'pontuacao_erro'              => 'required|min:0|max:100',
                'pontuacao_parcial'           => 'required|min:0|max:100',
                'pontuacao_acerto'            => 'required|min:0|max:100',
                'perguntas_por_grupo'         => 'required|min:1',
                'selecionar_tema_manualmente' => 'sometimes',
            ]);

            $ordem = $gincana->fases->count() + 1;

            $gincanaFase = new GincanaFase([
                'gincana_id'                  => $gincana->id,
                'nivel_id'                    => $request->nivel,
                'tipo'                        => $request->tipo,
                'ordem'                       => $ordem,
                'pontuacao_erro'              => $request->pontuacao_erro,
                'pontuacao_parcial'           => $request->pontuacao_parcial,
                'pontuacao_acerto'            => $request->pontuacao_acerto,
                'perguntas_por_grupo'         => $request->perguntas_por_grupo,
                'selecionar_tema_manualmente' => isset($request->selecionar_tema_manualmente) ? true : false,
            ]);

            $gincanaFase->save();
            $gincanaFase->temas()->attach($request->temas);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors(['message' => $th->getMessage()]);
        }

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
        try {
            DB::beginTransaction();

            $gincana = $gincanaFase->gincana;
            $gincanaFase->delete();

            // Reordena fases
            $ordem = 1;
            foreach ($gincana->fases->sortBy('ordem') as $fase) {
                $fase->update(['ordem' => $ordem++]);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors(['message' => $th->getMessage()]);
        }

        return redirect()->route('gincanas.edit', ['gincana' => $gincana->id]);
    }
}
