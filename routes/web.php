<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ola-mundo/', function(){
        return view('exercicios.index');
});