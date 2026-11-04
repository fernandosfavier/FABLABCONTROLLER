<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class FuncionarioController extends Controller
{
    public function salvar_funcionario(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'nif' => 'required|string|max:255|unique:funcionario,nif',
            'email' => 'required|email|max:255|unique:funcionario,email',
            'senha' => 'required|string|min:6',
            'tipo_usuario' => 'required|string|max:255',
            'status' => 'sometimes|boolean',
            'data_nascimento' => 'nullable|date'
        ]);

        $dados['senha'] = Hash::make($dados['senha']);

        $funcionario = Funcionario::create($dados);

        return response()->json([
            'mensagem' => 'Funcionário cadastrado com sucesso.',
            'funcionario' => $funcionario
        ], 201);
    }

    public function ver_funcionario(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        return response()->json(
            Funcionario::with('emprestimos')->findOrFail($request->id)
        );
    }

    public function listar_funcionarios()
    {
        return response()->json(
            Funcionario::with('emprestimos')
                ->orderBy('id', 'desc')
                ->get()
        );
    }

    public function listar_funcionarios_simples()
    {
        return response()->json(
            Funcionario::select('id', 'nome', 'nif', 'tipo_usuario', 'status')
                ->orderBy('nome')
                ->get()
        );
    }

    public function alterar_funcionario(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:funcionario,id'
        ]);

        $funcionario = Funcionario::findOrFail($request->id);

        $dados = $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'nif' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('funcionario', 'nif')->ignore($funcionario->id)
            ],
            'email' => [
                'sometimes',
                'required',
                'email',
                'max:255',
                Rule::unique('funcionario', 'email')->ignore($funcionario->id)
            ],
            'senha' => 'sometimes|nullable|string|min:6',
            'tipo_usuario' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|boolean',
            'data_nascimento' => 'sometimes|nullable|date'
        ]);

        if (!empty($dados['senha'])) {
            $dados['senha'] = Hash::make($dados['senha']);
        } else {
            unset($dados['senha']);
        }

        $funcionario->update($dados);

        return response()->json([
            'mensagem' => 'Funcionário atualizado com sucesso.',
            'funcionario' => $funcionario->fresh()
        ]);
    }

    public function deletar_funcionario(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:funcionario,id'
        ]);

        Funcionario::findOrFail($request->id)->delete();

        return response()->json([
            'mensagem' => 'Funcionário excluído com sucesso.'
        ]);
    }
}
