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
        'DISCURSIVA',
        'OBJETIVA',
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
        return $this->hasMany(Resposta::class);
    }
}
