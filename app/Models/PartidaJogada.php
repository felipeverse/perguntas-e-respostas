<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PartidaJogada extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable
     */
    protected $fillable = [
        'partida_id',
        'fase_id',
        'grupo_id',
        'pergunta_id',
        'resposta_id',
        'pergunta_ordem',
        'correta',
        'pontuacao',
    ];

    public function fase()
    {
        return $this->belongsTo(GincanaFase::class, 'fase_id');
    }

    public function grupo()
    {
        return $this->belongsTo(GincanaGrupo::class, 'grupo_id');
    }

    public function pergunta()
    {
        return $this->belongsTo(Pergunta::class, 'pergunta_id');
    }

    public function resposta()
    {
        return $this->belongsTo(Resposta::class, 'resposta_id');
    }
}
