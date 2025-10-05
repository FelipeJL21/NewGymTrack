<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'cpf',
        'rg',
        'data_nascimento',
        'endereco',
        'celular',
        'email',
        'data_matricula',
        'situacao',
    ];

    /**
     * Get the treinos for the aluno.
     */
    public function treinos()
    {
        return $this->hasMany(Treino::class);
    }
}