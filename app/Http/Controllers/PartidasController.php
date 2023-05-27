<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Gincana;
use App\Models\Partida;
use App\Models\Pergunta;
use App\Models\GincanaFase;
use App\Models\GincanaGrupo;
use Illuminate\Http\Request;
use App\Models\PartidaJogada;
use App\Models\PerguntaUtilizada;
use App\Models\Resposta;
use Illuminate\Support\Facades\DB;

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

        return redirect(route('partidas.index'));
    }

    public function play(Partida $partida)
    {
        try {
            // Identica a fase, grupo e Pergunta ordem atual
            $jogadaAtual = $this->getJogadaAtual($partida);

            // Caso exista uma jogada gera os dados da jogada e retorna para o usuário
            if (!is_null($jogadaAtual)) {
                $fase = $jogadaAtual['fase'];
                $perguntaOrdem = $jogadaAtual['perguntaOrdem'];
                $grupo = $jogadaAtual['grupo'];

                $pergunta = Pergunta::perguntaAleatoriaPorFase($jogadaAtual['fase'], $partida);

                if (is_null($pergunta) || $pergunta->count() == 0) {
                    throw new Exception('Não há mais perguntas disponíveis na banca.');
                };

                // Obtém as respostas relacionadas à pergunta
                $respostas = $pergunta->respostas;
                $respostasEmbaralhadas = $respostas->shuffle();
                $pergunta->setRelation('respostas', $respostasEmbaralhadas);

                return view('partidas.play', compact('partida', 'fase', 'grupo', 'pergunta', 'perguntaOrdem'));
            }

            // Finaliza partida
            $partida->finalizada = 1;
            $partida->save();
            $partida->refresh();

            $grupos = $partida->getGruposByPontuacao();

            return view('partidas.resultado-partida', compact('grupos'));
        } catch (\Throwable $th) {
            return back()->withErrors(['message' => $th->getMessage()]);
        }
    }

    public function storeResponse(Request $request, Partida $partida)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'fase-id' => 'required',
                'grupo-id' => 'required',
                'pergunta-ordem' => 'required',
                'pergunta-id' => 'required',
                'resposta-id' => 'sometimes',
                'ordem-das-respostas' => 'sometimes|array',
                'resultado' => 'sometimes',
            ]);

            // Valida se jogada recebida é integra com a jogada atual
            $jogadaRecebida = [
                'fase' => $request->input("fase-id"),
                'grupo' => $request->input("grupo-id"),
                'perguntaOrdem' => $request->input("pergunta-ordem"),
            ];

            $this->validarJogadaRecebida($partida, $jogadaRecebida);

            $fase = GincanaFase::find($request->input('fase-id'));
            $grupo = GincanaGrupo::find($request->input('grupo-id'));
            $pergunta = Pergunta::find($request->input('pergunta-id'));
            $respostaEnviada = Resposta::find($request->input('resposta-id'));
            $perguntaOrdem = $request->input("pergunta-ordem");

            $jogada = new PartidaJogada();

            // Salva jogada de pergunta objetiva
            if ($pergunta->tipo === 'OBJETIVA') {
                $acertouResposta = $pergunta->respostaCorreta->id == $respostaEnviada->id;

                $jogada = new PartidaJogada([
                    'partida_id' => $partida->id,
                    'fase_id' => $fase->id,
                    'grupo_id' => $grupo->id,
                    'pergunta_id' => $pergunta->id,
                    'resposta_id' => $respostaEnviada->id,
                    'pergunta_ordem' => $perguntaOrdem,
                    'correta' => $acertouResposta ? 'C' : 'E',
                    'pontuacao' => $acertouResposta ?
                        $fase->pontuacao_acerto
                        : $fase->pontuacao_erro
                ]);

                $perguntaUtilizada = new PerguntaUtilizada([
                    'partida_id' => $partida->id,
                    'pergunta_id' => $pergunta->id,
                ]);

                // Ordena perguntas conforme view de jogada
                $ordemDasRespostas = $request->input('ordem-das-respostas');

                $pergunta->respostas = $pergunta->respostas->sortBy(function ($resposta) use ($ordemDasRespostas) {
                    return array_search($resposta->id, $ordemDasRespostas);
                });

                $perguntaUtilizada->save();

                $jogada->save();
            } else {
                // Caso resposta seja errada
                if ($request->input('resultado') === 'errado') {
                    $correta = 'E';
                    $pontuacao = $fase->pontuacao_erro;
                }

                // Caso resposta seja parcial
                if ($request->input('resultado') == 'acerto-parcial') {
                    $correta = 'P';
                    $pontuacao = $fase->pontuacao_parcial;
                }

                // Caso resposta seja certa
                if ($request->input('resultado') == 'correta') {
                    $correta = 'C';
                    $pontuacao = $fase->pontuacao_acerto;
                }

                $jogada = new PartidaJogada([
                    'partida_id' => $partida->id,
                    'fase_id' => $fase->id,
                    'grupo_id' => $grupo->id,
                    'pergunta_id' => $pergunta->id,
                    'resposta_id' => $respostaEnviada->id,
                    'pergunta_ordem' => $perguntaOrdem,
                    'correta' => $correta,
                    'pontuacao' => $pontuacao,
                ]);

                $perguntaUtilizada = new PerguntaUtilizada([
                    'partida_id' => $partida->id,
                    'pergunta_id' => $pergunta->id,
                ]);

                $perguntaUtilizada->save();

                $jogada->save();
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return back()->withErrors(['message' => $th->getMessage()]);
        }

        return view('partidas.resultado-jogada', compact('partida', 'fase', 'grupo', 'jogada', 'pergunta', 'respostaEnviada', 'perguntaOrdem'));
    }

    public function destroy(Partida $partida)
    {
        $partida->delete();

        return redirect()->route('partidas.index')
            ->with('sucess', 'Pergunta excluída com sucesso!');
    }

    /**
     * Busca dados da jogada atual
     *
     * @param [type] $gincana
     *
     * @return Array
     */
    protected function getJogadaAtual($partida)
    {
        // Buscar gincana
        $gincana = $partida->gincana;
        $jogadaAtual = null;

        foreach ($gincana->fases->sortBy('ordem') as $fase) {
            for ($perguntaOrdem = 1; $perguntaOrdem <= $fase->perguntas_por_grupo; $perguntaOrdem++) {
                foreach ($gincana->grupos->sortBy('ordem') as $grupo) {
                    $jogou = PartidaJogada::where('partida_id', $partida->id)
                        ->where('fase_id', $fase->id)
                        ->where('grupo_id', $grupo->id)
                        ->where('pergunta_ordem', $perguntaOrdem)
                        ->get();

                    if ($jogou->isEmpty()) {
                        $jogadaAtual = [
                            'fase' => $fase,
                            'grupo' => $grupo,
                            'perguntaOrdem' => $perguntaOrdem,
                        ];
                        return $jogadaAtual;
                    }
                }
            }
        }
    }

    /**
     * Valida integridade da jogada recebida comparando com a jogada atual
     *
     * @param Partida $partida
     * @param array $jogadaRecebida
     *
     * @return void
     */
    protected function validarJogadaRecebida(Partida $partida, array $jogadaRecebida)
    {
        $jogadaAtualResponse = $this->getJogadaAtual($partida);

        $jogadaAtual = array_map(function ($item) {
            return is_object($item) ? $item->id : $item;
        }, $jogadaAtualResponse);

        if (array_diff_assoc($jogadaRecebida, $jogadaAtual) !== []) {
            throw new Exception("Erro de integridade entre jogada atual e jogada recebida!");
        }
    }
}
