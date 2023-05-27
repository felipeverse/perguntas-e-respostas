<?php

namespace App\Models;

use App\Models\Nivel;
use App\Models\Gincana;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GincanaFase extends Model
{
    use SoftDeletes;

    /**
     * The atttributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'ordem',
        'pontuacao_erro',
        'pontuacao_parcial',
        'pontuacao_acerto',
        'perguntas_por_grupo',
        'selecionar_tema_manualmente',
        'gincana_id',
        'nivel_id',
        'tipo',
    ];

    public function gincana()
    {
        return $this->belongsTo(Gincana::class);
    }

    public function nivel()
    {
        return $this->belongsTo(Nivel::class, 'nivel_id');
    }

    public function temas()
    {
        return $this->belongsToMany(Tema::class, 'gincana_fase_temas');
    }
}
