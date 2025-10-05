<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercicio extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'grupo_muscular',
        'descricao',
    ];

    /**
     * The treinos that belong to the exercicio.
     */
    public function treinos()
    {
        return $this->belongsToMany(Treino::class, 'exercicio_treino'); // 'exercicio_treino' é a tabela pivot
    }
}