<?php

namespace App\Http\Controllers;

use App\Models\Treino; 
use App\Models\Aluno;
use App\Models\Exercicio;
use Illuminate\Http\Request;

class TreinoController extends Controller
{
    public function index()
    {
        
        $treinos = Treino::with('aluno')->latest()->paginate(10);
        return view('treinos.index', compact('treinos'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        
        $alunos = Aluno::orderBy('nome')->get();
        $exercicios = Exercicio::orderBy('nome')->get();
        return view('treinos.create', compact('alunos', 'exercicios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'aluno_id' => 'required|exists:alunos,id',
            'tipo_treino' => 'required|string|max:1', 
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
            'exercicios' => 'required|array', 
            'exercicios.*' => 'exists:exercicios,id', existe
        ]);

        
        $treino = Treino::create($request->only([
            'aluno_id',
            'tipo_treino',
            'data_inicio',
            'data_fim'
        ]));

        
        $treino->exercicios()->attach($request->exercicios);

        return redirect()->route('treinos.index')
                         ->with('success', 'Treino montado com sucesso.');
    }

    
}