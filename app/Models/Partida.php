<?php

namespace App\Models;

use App\Models\GincanaGrupo;
use App\Models\PerguntaUtilizada;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partida extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'titulo',
        'finalizada',
        'gincana_id',
    ];

    public function gincana()
    {
        return $this->belongsTo(Gincana::class);
    }

    public function jogadas()
    {
        return $this->hasMany(PartidaJogada::class, 'partida_id');
    }

    public function perguntasUtilizadas()
    {
        return $this->hasMany(PerguntaUtilizada::class, 'partida_id');
    }

    public function getGruposByPontuacao()
    {
        $grupos = GincanaGrupo::select('gincana_grupos.*', DB::raw('SUM(partida_jogadas.pontuacao) as pontuacao_total'))
            ->join('partida_jogadas', 'gincana_grupos.id', '=', 'partida_jogadas.grupo_id')
            ->where('partida_jogadas.partida_id', $this->id)
            ->groupBy('gincana_grupos.id')
            ->orderBy('pontuacao_total', 'desc')
            ->get();

        return $grupos;
    }

    public function getStatusAttribute()
    {
        return $this->finalizada ? 'FINALIZADA' : ($this->jogadas->count()
            ? 'EM ANDAMENTO' : 'NÃO INICIADA');
    }
}
