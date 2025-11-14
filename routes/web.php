<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ola-mundo/', function(){
        $exercico = Exercicio::all();
        return view('exercicios.index') ->with('exercios',$exercico);
});