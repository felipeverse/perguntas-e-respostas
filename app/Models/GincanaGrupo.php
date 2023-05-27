<?php

namespace App\Models;

use App\Models\Gincana;
use App\Models\PartidaJogada;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GincanaGrupo extends Model
{
    use SoftDeletes;

    /**
     * The atttributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'ordem',
        'nome',
        'cor',
        'gincana_id',
    ];

    public function gincana()
    {
        return $this->belongsTo(Gincana::class);
    }
}
