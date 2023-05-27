<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerguntaUtilizada extends Model
{
    /**
     * Define table name
     *
     * @var string
     */
    protected $table = 'perguntas_utilizadas';

    /**
     * The attributes that are mass assignable
     */
    protected $fillable = [
        'partida_id',
        'pergunta_id',
    ];

    public function partida()
    {
        return $this->belongsTo(Partida::class, 'partida_id');
    }

    public function pergunta()
    {
        return $this->belongsTo(Pergunta::class, 'pergunta_id');
    }
}
