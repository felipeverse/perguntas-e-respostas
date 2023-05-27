<?php

namespace App\Models;

use App\Models\Tema;
use App\Models\Nivel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pergunta extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'enunciado',
        'tipo',
        'nivel_id',
        'tema_id',
    ];

    /**
     * Retorna os tipos de perguntas permitidos
     *
     * @var array
     */
    public const TIPOS = [
        'OBJETIVA',
        'DISCURSIVA',
    ];

    public function nivel()
    {
        return $this->belongsTo(Nivel::class);
    }

    public function tema()
    {
        return $this->belongsTo(Tema::class);
    }

    public function respostas()
    {
        return $this->hasMany(Resposta::class)->inRandomOrder();
    }

    public function getRespostaCorretaAttribute()
    {
        return $this->respostas()->where('correta', true)->first();
    }

    public static function perguntaAleatoriaPorFase(GincanaFase $fase, Partida $partida, $temaSelecionadoPreviamente = null)
    {
        if (is_null($temaSelecionadoPreviamente)) {
            return self::where('nivel_id', $fase->nivel_id)
                ->where('tipo', $fase->tipo)
                ->whereIn('tema_id', $fase->temas->pluck('id'))
                ->whereNotIn('id', $partida->perguntasUtilizadas->pluck('pergunta_id'))
                ->first();
        }

        return self::where('nivel_id', $fase->nivel_id)
            ->where('tipo', $fase->tipo)
            ->where('tema_id', $temaSelecionadoPreviamente)
            ->get()
            ->random();
    }
}
