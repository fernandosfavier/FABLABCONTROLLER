<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use Illuminate\Http\Request;

class EmprestimoController extends Controller
{
    public function salvar_emprestimo(Request $request)
    {
        $dados = $request->validate([
            'funcionario_id' => 'required|integer|exists:funcionario,id',
            'sala_id' => 'required|integer|exists:sala,id',
            'data_retirada' => 'required|date',
            'data_prevista_devolucao' => 'nullable|date|after_or_equal:data_retirada',
            'data_devolucao' => 'nullable|date|after_or_equal:data_retirada',
            'status' => 'sometimes|required|in:Aberto,Fechado,Cancelado',
            'observacao' => 'nullable|string'
        ]);

        $dados['status'] = $dados['status'] ?? 'Aberto';

        $emprestimo = Emprestimo::create($dados);

        return response()->json([
            'mensagem' => 'Empréstimo cadastrado com sucesso.',
            'emprestimo' => $emprestimo->load([
                'funcionario',
                'sala',
                'itens.equipamento'
            ])
        ], 201);
    }

    public function ver_emprestimo(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        return response()->json(
            Emprestimo::with([
                'funcionario',
                'sala',
                'itens.equipamento'
            ])->findOrFail($request->id)
        );
    }

    public function listar_emprestimos()
    {
        return response()->json(
            Emprestimo::with([
                'funcionario',
                'sala',
                'itens.equipamento'
            ])->orderBy('id', 'desc')->get()
        );
    }

    public function listar_emprestimos_simples()
    {
        return response()->json(
            Emprestimo::select(
                'id',
                'funcionario_id',
                'sala_id',
                'data_retirada',
                'data_prevista_devolucao',
                'data_devolucao',
                'status'
            )->with([
                'funcionario:id,nome,nif',
                'sala:id,nome'
            ])->orderBy('id', 'desc')->get()
        );
    }

    public function alterar_emprestimo(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:emprestimo,id'
        ]);

        $emprestimo = Emprestimo::findOrFail($request->id);

        $dados = $request->validate([
            'funcionario_id' => 'sometimes|required|integer|exists:funcionario,id',
            'sala_id' => 'sometimes|required|integer|exists:sala,id',
            'data_retirada' => 'sometimes|required|date',
            'data_prevista_devolucao' => 'sometimes|nullable|date',
            'data_devolucao' => 'sometimes|nullable|date',
            'status' => 'sometimes|required|in:Aberto,Fechado,Cancelado',
            'observacao' => 'sometimes|nullable|string'
        ]);

        $emprestimo->update($dados);

        return response()->json([
            'mensagem' => 'Empréstimo atualizado com sucesso.',
            'emprestimo' => $emprestimo->fresh([
                'funcionario',
                'sala',
                'itens.equipamento'
            ])
        ]);
    }

    public function deletar_emprestimo(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:emprestimo,id'
        ]);

        $emprestimo = Emprestimo::with('itens')->findOrFail($request->id);

        if ($emprestimo->itens()->exists()) {
            return response()->json([
                'mensagem' => 'Não é possível excluir um empréstimo com itens vinculados. Preserve o histórico ou implemente um cancelamento.'
            ], 422);
        }

        $emprestimo->delete();

        return response()->json([
            'mensagem' => 'Empréstimo excluído com sucesso.'
        ]);
    }
}
