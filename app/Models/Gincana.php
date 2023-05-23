<?php

namespace App\Models;

use App\Models\GincanaGrupo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gincana extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The atttributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'descricao',
    ];

    /**
     * Grupos relacionados à gincana
     *
     * @return void
     */
    public function grupos()
    {
        return $this->hasMany(GincanaGrupo::class);
    }

    /**
     * Fases relacionadas à gincana
     */
    public function fases()
    {
        return $this->hasMany(GincanaFase::class);
    }
}
