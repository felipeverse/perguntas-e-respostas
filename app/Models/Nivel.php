<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    use HasFactory;

    /**
     * Define table name
     *
     * @var string
     */
    protected $table = 'niveis';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['titulo'];

    /**
     * Perguntas relacionadas ao nível
     */
    public function perguntas()
    {
        return $this->hasMany(Pergunta::class);
    }
}
