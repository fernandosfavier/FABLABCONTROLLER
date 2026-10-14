<?php

use Illuminate\Support\Facades\Route;


Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/agendamento', function () {
    return view('agendamento');
})->name('agendamento');

Route::get('/agendamento/novo', function () {
    return view('novo_agendamento');
})->name('agendamento.novo');

Route::get('/agendamento/detalhe', function () {
    return view('detalhe_agendamento');
})->name('agendamento.detalhe');

Route::get('/agendamento/devolucao', function () {
    return view('devolucao');
})->name('agendamento.devolucao');

Route::get('/equipamento', function () {
    return view('equipamento');
})->name('equipamento');

Route::get('/equipamento/cadastro', function () {
    return view('cadastro_equipamento');
})->name('equipamento.cadastro');

Route::get('/equipamento/detalhe', function () {
    return view('detalhe_equipamento');
})->name('equipamento.detalhe');
