<?php

namespace App\Http\Controllers;

use App\Models\Equipamento;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EquipamentoController extends Controller
{
    public function salvar_equipamento(Request $request)
    {
        $dados = $request->validate([
            'patrimonio' => 'required|string|max:255|unique:equipamento,patrimonio',
            'nome' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'modelo' => 'nullable|string|max:255',
            'status' => 'sometimes|required|string|max:255',
            'observacao' => 'nullable|string'
        ]);

        $equipamento = Equipamento::create($dados);

        return response()->json([
            'mensagem' => 'Equipamento cadastrado com sucesso.',
            'equipamento' => $equipamento
        ], 201);
    }

    public function ver_equipamento(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        return response()->json(
            Equipamento::with('itensEmprestimo.emprestimo')
                ->findOrFail($request->id)
        );
    }

    public function listar_equipamentos()
    {
        return response()->json(
            Equipamento::with('itensEmprestimo')
                ->orderBy('id', 'desc')
                ->get()
        );
    }

    public function listar_equipamentos_simples()
    {
        return response()->json(
            Equipamento::select(
                'id',
                'patrimonio',
                'nome',
                'tipo',
                'status'
            )->orderBy('nome')->get()
        );
    }

    public function alterar_equipamento(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:equipamento,id'
        ]);

        $equipamento = Equipamento::findOrFail($request->id);

        $dados = $request->validate([
            'patrimonio' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('equipamento', 'patrimonio')
                    ->ignore($equipamento->id)
            ],
            'nome' => 'sometimes|required|string|max:255',
            'tipo' => 'sometimes|required|string|max:255',
            'modelo' => 'sometimes|nullable|string|max:255',
            'status' => 'sometimes|required|string|max:255',
            'observacao' => 'sometimes|nullable|string'
        ]);

        $equipamento->update($dados);

        return response()->json([
            'mensagem' => 'Equipamento atualizado com sucesso.',
            'equipamento' => $equipamento->fresh()
        ]);
    }

    public function deletar_equipamento(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:equipamento,id'
        ]);

        $equipamento = Equipamento::findOrFail($request->id);

        if ($equipamento->itensEmprestimo()->exists()) {
            return response()->json([
                'mensagem' => 'Não é possível excluir um equipamento que possui histórico de empréstimos.'
            ], 422);
        }

        $equipamento->delete();

        return response()->json([
            'mensagem' => 'Equipamento excluído com sucesso.'
        ]);
    }
}
