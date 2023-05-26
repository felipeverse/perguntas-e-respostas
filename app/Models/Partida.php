<?php

namespace App\Models;

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

    public function getStatusAttribute()
    {
        return $this->finalizada ? 'FINALIZADA' : ($this->jogadas->count()
            ? 'EM ANDAMENTO' : 'NÃO INICIADA');
    }
}
