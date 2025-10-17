<?php

namespace App\Http\Controllers;

use App\Models\Aluno; 
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function index()
    {
        $alunos = Aluno::latest()->paginate(10);
        return view('alunos.index', compact('alunos'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('alunos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|unique:alunos|max:14',
            'rg' => 'required|string|max:20',
            'data_nascimento' => 'required|date',
            'endereco' => 'required|string|max:255',
            'celular' => 'required|string|max:20',
            'email' => 'required|string|email|unique:alunos|max:255',
            'data_matricula' => 'required|date',
            'situacao' => 'required|string',
        ]);

        Aluno::create($request->all());

        return redirect()->route('alunos.index')
                        ->with('success', 'Aluno cadastrado com sucesso.');
    }

    public function show(Aluno $aluno)
    {
        return view('alunos.show', compact('aluno'));
    }

    public function edit(Aluno $aluno)
    {
        return view('alunos.edit', compact('aluno'));
    }

    public function update(Request $request, Aluno $aluno)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:alunos,cpf,' . $aluno->id,
            'rg' => 'required|string|max:20',
            'data_nascimento' => 'required|date',
            'endereco' => 'required|string|max:255',
            'celular' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:alunos,email,' . $aluno->id,
            'data_matricula' => 'required|date',
            'situacao' => 'required|string',
        ]);

        $aluno->update($request->all());

        return redirect()->route('alunos.index')
                        ->with('success', 'Dados do aluno atualizados com sucesso.');
    }

    public function destroy(Aluno $aluno)
    {
        $aluno->delete();

        return redirect()->route('alunos.index')
                        ->with('success', 'Aluno excluído com sucesso.');
    }
}