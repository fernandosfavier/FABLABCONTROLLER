<?php

use App\Http\Middleware\LogadoAdminMiddleware;
use App\Http\Middleware\LogadoWebMiddleware;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\UsuarioController;

Route::get('/loginteste', function () {
    return view('loginteste');
})->name('loginteste');

Route::middleware([LogadoWebMiddleware::class])->group(function () {

    Route::get('/home', function (Request $request) {
        return view('home', [
            'usuario' => $request->input('usuario'),
        ]);
    })->name('home');

    Route::get('/agendamento', function () {
        return view('agendamento');
    })->name('agendamento');

    Route::get('/equipamento', function () {
        return view('equipamento');
    })->name('equipamento');

    Route::get('/novo_agendamento', function () {
        return view('novo_agendamento');
    })->name('novo_agendamento');

    Route::get('/detalhe_agendamento', function () {
        return view('detalhe_agendamento');
    })->name('detalhe_agendamento');

    Route::get('/devolucao', function () {
        return view('devolucao');
    })->name('devolucao');

    Route::middleware([LogadoAdminMiddleware::class])->group(function () {

        Route::get('/painel', function () {
            return view('painel');
        })->name('painel');

        Route::get('/cadastro_equipamento', function () {
            return view('cadastro_equipamento');
        })->name('cadastro_equipamento');

    });

   Route::get('/funcionario_teste',[FuncionarioController::class, 'funcionario_teste'])->name('funcionario_teste');

});
