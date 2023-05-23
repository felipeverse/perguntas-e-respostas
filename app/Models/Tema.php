<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['titulo'];

    /**
     * Perguntas relacionadas ao tema
     */
    public function perguntas()
    {
        return $this->hasMany(Pergunta::class);
    }

    public function fases()
    {
        return $this->belongsToMany(GincanaFase::class, 'gincana_fase_temas');
    }
}
