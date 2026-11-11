
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use app\Http\Controllers\UsuarioTokenController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\EquipamentoController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\ItemEmprestimoController;
use App\Http\Middleware\LoginMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\LogoutMiddleware;
use App\Http\Controllers\LoginController;

Route::post('/cadastrar_usuario', [UsuarioController::class, 'cadastrar_usuario']);
Route::get('/ver_usuario', [UsuarioController::class, 'ver_usuario']);
Route::get('/listar_usuarios', [UsuarioController::class, 'listar_usuarios']);
Route::get('/listar_usuarios_simples', [UsuarioController::class, 'listar_usuarios_simples']);
Route::put('/alterar_usuario', [UsuarioController::class, 'alterar_usuario']);
Route::delete('/deletar_usuario', [UsuarioController::class, 'deletar_usuario']);

Route::post('/cadastrar_funcionario', [FuncionarioController::class, 'cadastrar_funcionario']);
Route::get('/ver_funcionario', [FuncionarioController::class, 'ver_funcionario']);
Route::get('/listar_funcionarios', [FuncionarioController::class, 'listar_funcionarios']);
Route::get('/listar_funcionarios_simples', [FuncionarioController::class, 'listar_funcionarios_simples']);
Route::put('/alterar_funcionario', [FuncionarioController::class, 'alterar_funcionario']);
Route::delete('/deletar_funcionario', [FuncionarioController::class, 'deletar_funcionario']);

Route::post('/cadastrar_equipamento', [EquipamentoController::class, 'cadastrar_equipamento']);
Route::get('/ver_equipamento', [EquipamentoController::class, 'ver_equipamento']);
Route::get('/listar_equipamentos', [EquipamentoController::class, 'listar_equipamentos']);
Route::get('/listar_equipamentos_simples', [EquipamentoController::class, 'listar_equipamentos_simples']);
Route::put('/alterar_equipamento', [EquipamentoController::class, 'alterar_equipamento']);
Route::delete('/deletar_equipamento', [EquipamentoController::class, 'deletar_equipamento']);

Route::post('/cadastrar_sala', [SalaController::class, 'cadastrar_sala']);
Route::get('/ver_sala', [SalaController::class, 'ver_sala']);
Route::get('/listar_salas', [SalaController::class, 'listar_salas']);
Route::get('/listar_salas_simples', [SalaController::class, 'listar_salas_simples']);
Route::put('/alterar_sala', [SalaController::class, 'alterar_sala']);
Route::delete('/deletar_sala', [SalaController::class, 'deletar_sala']);

Route::post('/cadastrar_emprestimo', [EmprestimoController::class, 'cadastrar_emprestimo']);
Route::get('/ver_emprestimo', [EmprestimoController::class, 'ver_emprestimo']);
Route::get('/listar_emprestimos', [EmprestimoController::class, 'listar_emprestimos']);
Route::get('/listar_emprestimos_simples', [EmprestimoController::class, 'listar_emprestimos_simples']);
Route::put('/alterar_emprestimo', [EmprestimoController::class, 'alterar_emprestimo']);
Route::delete('/deletar_emprestimo', [EmprestimoController::class, 'deletar_emprestimo']);

Route::post('/cadastrar_item_emprestimo', [ItemEmprestimoController::class, 'cadastrar_item_emprestimo']);
Route::get('/ver_item_emprestimo', [ItemEmprestimoController::class, 'ver_item_emprestimo']);
Route::get('/listar_itens_emprestimo', [ItemEmprestimoController::class, 'listar_itens_emprestimo']);
Route::get('/listar_itens_emprestimo_simples', [ItemEmprestimoController::class, 'listar_itens_emprestimo_simples']);
Route::put('/alterar_item_emprestimo', [ItemEmprestimoController::class, 'alterar_item_emprestimo']);
Route::delete('/deletar_item_emprestimo', [ItemEmprestimoController::class, 'deletar_item_emprestimo']);

Route::post('/login', [UsuarioController::class, 'login']);
Route::post('/logout', [LogoutController::class, 'logout'])->middleware('logout');
Route::post('/painel', function () {
    return response()->json(['message' => 'Você é um administrador!'], 200);
})->middleware(AdminMiddleware::class);