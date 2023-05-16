<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use App\Models\Nivel;
use App\Models\Pergunta;
use App\Models\Resposta;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PerguntasController extends Controller
{
    /**
     * Lista as perguntas cadastrados
     *
     * @return void
     */
    public function index()
    {
        $perguntas = Pergunta::all();

        return view('perguntas.index', compact('perguntas'));
    }

    /**
     * Mostra o formulário de criação de uma nova pergunta
     *
     * @return void
     */
    public function create()
    {
        // Busca níveis para serem usados no select da pergunta
        $niveis = Nivel::all();

        // Busca temas para serem usados no select da pergunta
        $temas = Tema::all();

        // Busca os tipos de perguntas para serem usados no select da perguntas
        $tipos = Pergunta::TIPOS;

        return view('perguntas.create', compact('niveis', 'temas', 'tipos'));
    }

    /**
     * Salvar uma nova pergunta
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Realizar validações gerais
        $request->validate([
            'enunciado' => 'filled',
            'nivel'     => 'required',
            'tema'      => 'required',
            'tipo'      => [
                'required',
                Rule::in(Pergunta::TIPOS),
            ]
        ]);

        $pergunta = new Pergunta([
            'enunciado' => $request->enunciado,
            'nivel_id'  => $request->nivel,
            'tema_id'   => $request->tema,
            'tipo'      => $request->tipo,
        ]);

        // Salva respostas das perguntas do tipo objetiva
        if ($request->tipo === 'OBJETIVA') {
            $request->validate([
                'respostas' => 'required|array|size:4',
                'correta'   => 'required|int',
            ]);

            $respostas = [];

            foreach ($request->respostas as $key => $resposta) {
                $respostas[] = new Resposta([
                    'texto' => $resposta,
                    'correta' => $key == $request->correta,
                ]);
            }
        }

        // Salva respostas das perguntas do tipo discursiva
        if ($request->tipo === 'DISCURSIVA') {
            $request->validate([
                'resposta' => 'required',
            ]);

            $respostas[] = new Resposta([
                'texto' => $request->resposta,
                'correta' => true,
            ]);
        }

        $pergunta->save();
        $pergunta->respostas()->saveMany($respostas);

        return redirect()->route('perguntas.index')->with('success', 'Pergunta criada com sucesso!');
    }

    /**
     * Mostra o formulário de edição de pergunta
     *
     * @param Pergunta $perguntas
     *
     * @return Response
     */
    public function edit(Pergunta $pergunta)
    {
        // Busca níveis para serem usados no select da pergunta
        $niveis = Nivel::all();

        // Busca temas para serem usados no select da pergunta
        $temas = Tema::all();

        // Busca os tipos de perguntas para serem usados no select da perguntas
        $tipos = Pergunta::TIPOS;

        return view('perguntas.edit', compact('pergunta', 'niveis', 'temas', 'tipos'));
    }

    /**
     * Mosta os detalhes da pergunta
     *
     * @param Pergunta $pergunta
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Pergunta $pergunta)
    {
        return view('perguntas.show', compact('pergunta'));
    }

    public function update(Request $request, Pergunta $pergunta)
    {
        // Realizar validações gerais
        $request->validate([
            'enunciado' => 'filled',
            'nivel'     => 'required',
            'tema'      => 'required',
            'tipo'      => [
                'required',
                Rule::in(Pergunta::TIPOS),
            ]
        ]);

        $pergunta->update([
            'enunciado' => $request->enunciado,
            'nivel_id'  => $request->nivel,
            'tema_id'   => $request->tema,
            'tipo'      => $request->tipo,
        ]);

        // Salva respostas das perguntas do tipo objetiva
        if ($request->tipo === 'OBJETIVA') {
            $request->validate([
                'respostas' => 'required|array|size:4',
                'correta'   => 'required|int',
            ]);

            $respostas = [];

            foreach ($request->respostas as $key => $resposta) {
                $respostas[] = new Resposta([
                    'texto' => $resposta,
                    'correta' => $key == $request->correta,
                ]);
            }
        }

        // Salva respostas das perguntas do tipo discursiva
        if ($request->tipo === 'DISCURSIVA') {
            $request->validate([
                'resposta' => 'required',
            ]);

            $respostas[] = new Resposta([
                'texto' => $request->resposta,
                'correta' => true,
            ]);
        }

        $pergunta->respostas()->delete();
        $pergunta->respostas()->saveMany($respostas);

        return redirect()->route('perguntas.index')->with('success', 'Pergunta atualizada com sucesso!');
    }

    /**
     * Excluir um nível
     *
     * @param  \App\Models\Pergunta $pergunta
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pergunta $pergunta)
    {
        $pergunta->respostas()->delete();
        $pergunta->delete();

        return redirect()->route('perguntas.index')
            ->with('sucess', 'Pergunta excluída com sucesso!');
    }
}
