<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\Equipamento;
use App\Models\ItemEmprestimo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemEmprestimoController extends Controller
{
    public function salvar_item_emprestimo(Request $request)
    {
        $dados = $request->validate([
            'emprestimo_id' => 'required|integer|exists:emprestimo,id',
            'equipamento_id' => 'required|integer|exists:equipamento,id',
            'estado_retirada' => 'nullable|string|max:255',
            'estado_devolucao' => 'nullable|string|max:255',
            'observacao' => 'nullable|string'
        ]);

        $item = DB::transaction(function () use ($dados) {
            $emprestimo = Emprestimo::whereKey($dados['emprestimo_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if ($emprestimo->status !== 'Aberto') {
                abort(422, 'Só é possível adicionar equipamentos a empréstimos abertos.');
            }

            $equipamento = Equipamento::whereKey($dados['equipamento_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if ($equipamento->status !== 'Disponivel') {
                abort(422, 'O equipamento não está disponível para empréstimo.');
            }

            $itemExistente = ItemEmprestimo::where('emprestimo_id', $emprestimo->id)
                ->where('equipamento_id', $equipamento->id)
                ->exists();

            if ($itemExistente) {
                abort(422, 'Este equipamento já está vinculado a esse empréstimo.');
            }

            $item = ItemEmprestimo::create($dados);

            $equipamento->update([
                'status' => 'Emprestado'
            ]);

            return $item;
        });

        return response()->json([
            'mensagem' => 'Item de empréstimo cadastrado com sucesso.',
            'item' => $item->load(['emprestimo', 'equipamento'])
        ], 201);
    }

    public function ver_item_emprestimo(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        return response()->json(
            ItemEmprestimo::with([
                'emprestimo.funcionario',
                'emprestimo.sala',
                'equipamento'
            ])->findOrFail($request->id)
        );
    }

    public function listar_itens_emprestimo()
    {
        return response()->json(
            ItemEmprestimo::with([
                'emprestimo.funcionario',
                'emprestimo.sala',
                'equipamento'
            ])->orderBy('id', 'desc')->get()
        );
    }

    public function listar_itens_emprestimo_simples()
    {
        return response()->json(
            ItemEmprestimo::with([
                'emprestimo:id,funcionario_id,sala_id,status',
                'equipamento:id,patrimonio,nome,status'
            ])->orderBy('id', 'desc')->get()
        );
    }

    public function alterar_item_emprestimo(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:item_emprestimo,id'
        ]);

        $item = ItemEmprestimo::findOrFail($request->id);

        $dados = $request->validate([
            'estado_retirada' => 'sometimes|nullable|string|max:255',
            'estado_devolucao' => 'sometimes|nullable|string|max:255',
            'observacao' => 'sometimes|nullable|string'
        ]);

        $item->update($dados);

        return response()->json([
            'mensagem' => 'Item de empréstimo atualizado com sucesso.',
            'item' => $item->fresh([
                'emprestimo',
                'equipamento'
            ])
        ]);
    }

    public function deletar_item_emprestimo(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:item_emprestimo,id'
        ]);

        $item = ItemEmprestimo::with('emprestimo', 'equipamento')
            ->findOrFail($request->id);

        if ($item->emprestimo->status === 'Aberto') {
            return response()->json([
                'mensagem' => 'Não exclua um item de empréstimo aberto. Registre a devolução ou cancele o empréstimo.'
            ], 422);
        }

        $item->delete();

        return response()->json([
            'mensagem' => 'Item de empréstimo excluído com sucesso.'
        ]);
    }
}
