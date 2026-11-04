<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    public function salvar_sala(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'bloco' => 'nullable|string|max:255',
            'observacao' => 'nullable|string'
        ]);

        $sala = Sala::create($dados);

        return response()->json([
            'mensagem' => 'Sala cadastrada com sucesso.',
            'sala' => $sala
        ], 201);
    }

    public function ver_sala(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        return response()->json(
            Sala::with('emprestimos')->findOrFail($request->id)
        );
    }

    public function listar_salas()
    {
        return response()->json(
            Sala::with('emprestimos')->orderBy('nome')->get()
        );
    }

    public function listar_salas_simples()
    {
        return response()->json(
            Sala::select('id', 'nome', 'bloco')->orderBy('nome')->get()
        );
    }

    public function alterar_sala(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:sala,id'
        ]);

        $sala = Sala::findOrFail($request->id);

        $dados = $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'bloco' => 'sometimes|nullable|string|max:255',
            'observacao' => 'sometimes|nullable|string'
        ]);

        $sala->update($dados);

        return response()->json([
            'mensagem' => 'Sala atualizada com sucesso.',
            'sala' => $sala->fresh()
        ]);
    }

    public function deletar_sala(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:sala,id'
        ]);

        $sala = Sala::findOrFail($request->id);

        if ($sala->emprestimos()->exists()) {
            return response()->json([
                'mensagem' => 'Não é possível excluir uma sala que possui histórico de empréstimos.'
            ], 422);
        }

        $sala->delete();

        return response()->json([
            'mensagem' => 'Sala excluída com sucesso.'
        ]);
    }
}
