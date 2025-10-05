<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treino extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'aluno_id',
        'tipo_treino',
        'data_inicio',
        'data_fim',
    ];

    /**
     * Get the aluno that owns the treino.
     */
    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    /**
     * The exercicios that belong to the treino.
     */
    public function exercicios()
    {
        return $this->belongsToMany(Exercicio::class, 'exercicio_treino'); // 'exercicio_treino' é a tabela pivot
    }
}