<?php

namespace App\Http\Controllers;

use App\Models\Funcionario; 
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $funcionarios = Funcionario::latest()->paginate(10);
        return view('funcionarios.index', compact('funcionarios'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('funcionarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|unique:funcionarios|max:14',
            'rg' => 'required|string|max:20',
            'data_nascimento' => 'required|date',
            'endereco' => 'required|string|max:255',
            'celular' => 'required|string|max:20',
            'email' => 'required|string|email|unique:funcionarios|max:255',
            'cargo' => 'required|string|max:255',
            'salario' => 'required|numeric',
            'data_admissao' => 'required|date',
        ]);

       
        Funcionario::create($request->all());

       
        return redirect()->route('funcionarios.index')
                         ->with('success','Funcionário cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Funcionario $funcionario)
    {
        
        return view('funcionarios.show', compact('funcionario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Funcionario $funcionario)
    {
        
        return view('funcionarios.edit', compact('funcionario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Funcionario $funcionario)
    {
        
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:funcionarios,cpf,' . $funcionario->id,
            'rg' => 'required|string|max:20',
            'data_nascimento' => 'required|date',
            'endereco' => 'required|string|max:255',
            'celular' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:funcionarios,email,' . $funcionario->id,
            'cargo' => 'required|string|max:255',
            'salario' => 'required|numeric',
            'data_admissao' => 'required|date',
        ]);

        
        $funcionario->update($request->all());

       
        return redirect()->route('funcionarios.index')
                         ->with('success','Dados do funcionário atualizados com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Funcionario $funcionario)
    {
       
        $funcionario->delete();

        
        return redirect()->route('funcionarios.index')
                         ->with('success','Funcionário excluído com sucesso.');
    }
}