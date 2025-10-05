<?php

namespace App\Http\Controllers;

use App\Models\Exercicio; 
use Illuminate\Http\Request;

class ExercicioController extends Controller
{
    public function index()
    {
        $exercicios = Exercicio::latest()->paginate(10);
        return view('exercicios.index', compact('exercicios'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('exercicios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|unique:exercicios|max:255',
            'grupo_muscular' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        Exercicio::create($request->all());

        return redirect()->route('exercicios.index')
                         ->with('success', 'Exercício cadastrado com sucesso.');
    }

    public function show(Exercicio $exercicio)
    {
        return view('exercicios.show', compact('exercicio'));
    }

    public function edit(Exercicio $exercicio)
    {
        return view('exercicios.edit', compact('exercicio'));
    }

    public function update(Request $request, Exercicio $exercicio)
    {
        $request->validate([
            'nome' => 'required|string|max:255|unique:exercicios,nome,' . $exercicio->id,
            'grupo_muscular' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        $exercicio->update($request->all());

        return redirect()->route('exercicios.index')
                         ->with('success', 'Exercício atualizado com sucesso.');
    }

    public function destroy(Exercicio $exercicio)
    {
        $exercicio->delete();

        return redirect()->route('exercicios.index')
                         ->with('success', 'Exercício excluído com sucesso.');
    }
}