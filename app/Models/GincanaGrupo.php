<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Gincana;

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
