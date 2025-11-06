<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Exercicio extends Model
{
    use HasFactory;

    /**
     * O nome da tabela associada ao model.
     * (Opcional se o nome for o plural do model, mas bom para clareza)
     *
     * @var string
     */
    protected $table = 'exercicios';

    /**
     * A chave primária da tabela.
     * (Necessário pois você usou 'id_exercicio' em vez do padrão 'id')
     *
     * @var string
     */
    protected $primaryKey = 'id_exercicio';

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'grupo_muscular',
        'descricao',
    ];

    /**
     * Define o relacionamento N:N (Muitos-para-Muitos) com Treino.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function treinos(): BelongsToMany
    {
        return $this->belongsToMany(
            Treino::class,      // O Model relacionado
            'exercicio_treino', // A tabela pivot
            'exercicio_id',     // Chave estrangeira deste model na pivot
            'treino_id'         // Chave estrangeira do outro model na pivot
        );
    }
}