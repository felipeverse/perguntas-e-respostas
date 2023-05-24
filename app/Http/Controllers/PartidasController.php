<?php

namespace App\Http\Controllers;

use App\Models\Gincana;
use App\Models\Partida;
use App\Models\Pergunta;
use Illuminate\Http\Request;
use App\Models\PartidaJogada;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PartidasController extends Controller
{
    public function index()
    {
        $partidas = Partida::all();

        return view('partidas.index', compact('partidas'));
    }

    public function create()
    {
        $gincanas = Gincana::all();

        return view('partidas.create', compact('gincanas'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'titulo' => 'required',
                'gincana' => 'required',
            ]);

            Partida::create([
                'titulo' => $request->titulo,
                'gincana_id' => $request->gincana,
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors(['message' => $th->getMessage()]);
        }
    }

    public function play(Partida $partida)
    {
        try {
            // Buscar gincana
            $gincana = $partida->gincana;

            // Identica a fase, grupo e Pergunta ordem atual
            $proximo = collect();
            foreach ($gincana->fases->sortBy('ordem') as $fase) {
                for ($perguntaOrdem = 1; $perguntaOrdem <= $fase->perguntas_por_grupo; $perguntaOrdem++) {
                    foreach ($gincana->grupos->sortBy('ordem') as $grupo) {
                        $jogou = PartidaJogada::where('partida_id', $partida->id)
                            ->where('fase_id', $fase->id)
                            ->where('grupo_id', $grupo->id)
                            ->where('pergunta_ordem', $perguntaOrdem)
                            ->get();

                        if ($jogou->isEmpty()) {
                            $proximo = [
                                'fase' => $fase,
                                'grupo' => $grupo,
                                'pergunta_ordem' => $perguntaOrdem,
                            ];
                            break 3;
                        }
                    }
                }
            }

            Log::info($proximo);

            // Tratar necessidade de selionar tema previamente da fase para redirecionar para rota de seleção dee tema

        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors(['message' => $th->getMessage()]);
        }

        if (count($proximo)) {
            // Busca pergunta que atendam aos parâmetros
            $pergunta = Pergunta::perguntaAleatoriaPorFase($proximo['fase']);
            dd($pergunta->getAttributes());
        }
    }
}
