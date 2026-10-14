<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use Illuminate\Http\Request;

class EmprestimoController extends Controller
{
    public function salvar_emprestimo(Request $request)
    {
        $request->validate([
            'funcionario_id' => 'required|integer|exists:funcionario,id',
            'sala_id' => 'required|integer|exists:sala,id',
            'data_retirada' => 'required|date',
            'data_prevista_devolucao' => 'nullable|date',
            'data_devolucao' => 'nullable|date',
            'status' => 'required|string|max:255',
            'observacao' => 'nullable|string',
        ]);

        try {

            $emprestimo = new Emprestimo();

            $emprestimo->funcionario_id = $request->funcionario_id;
            $emprestimo->sala_id = $request->sala_id;
            $emprestimo->data_retirada = $request->data_retirada;
            $emprestimo->data_prevista_devolucao = $request->data_prevista_devolucao;
            $emprestimo->data_devolucao = $request->data_devolucao;
            $emprestimo->status = $request->status;
            $emprestimo->observacao = $request->observacao;

            $emprestimo->save();

            return response()->json([
                'mensagem' => 'Empréstimo cadastrado com sucesso!',
                'error' => 'n',
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'mensagem' => 'Erro ao cadastrar empréstimo',
                'error' => 's',
                'msg_erro' => $th->getMessage(),
            ], 500);
        }
    }

    public function ver_emprestimo(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        $emprestimo = Emprestimo::with([
            'funcionario',
            'sala',
            'itens.equipamento'
        ])->find($request->id);

        if ($emprestimo) {

            return response()->json([
                'mensagem' => 'Empréstimo encontrado com sucesso!',
                'error' => 'n',
                'emprestimo' => $emprestimo,
            ], 200);

        } else {

            return response()->json([
                'mensagem' => 'Empréstimo não encontrado',
                'error' => 's',
            ], 200);
        }
    }

    public function listar_emprestimos()
    {
        $emprestimos = Emprestimo::with([
            'funcionario',
            'sala'
        ])->get();

        return response()->json([
            'emprestimos' => $emprestimos,
        ], 200);
    }

    public function listar_emprestimos_simples()
    {
        $emprestimos = Emprestimo::select(
            'id',
            'funcionario_id',
            'sala_id',
            'data_retirada',
            'data_prevista_devolucao',
            'data_devolucao',
            'status'
        )->get();

        return response()->json([
            'emprestimos' => $emprestimos,
        ], 200);
    }

    public function alterar_emprestimo(Request $request)
    {
        try {

            $emprestimo = Emprestimo::find($request->id);

            if (!$emprestimo) {

                return response()->json([
                    'mensagem' => 'Empréstimo não encontrado',
                    'error' => 's',
                ], 200);
            }

            $emprestimo->funcionario_id = $request->funcionario_id;
            $emprestimo->sala_id = $request->sala_id;
            $emprestimo->data_retirada = $request->data_retirada;
            $emprestimo->data_prevista_devolucao = $request->data_prevista_devolucao;
            $emprestimo->data_devolucao = $request->data_devolucao;
            $emprestimo->status = $request->status;
            $emprestimo->observacao = $request->observacao;

            $emprestimo->save();

            return response()->json([
                'mensagem' => 'Empréstimo alterado com sucesso!',
                'error' => 'n',
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'mensagem' => 'Erro ao alterar empréstimo',
                'error' => 's',
                'msg_erro' => $th->getMessage(),
            ], 500);
        }
    }

    public function deletar_emprestimo(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:emprestimo,id',
        ]);

        try {

            $emprestimo = Emprestimo::find($request->id);

            $emprestimo->delete();

            return response()->json([
                'mensagem' => 'Empréstimo deletado com sucesso!',
                'error' => 'n',
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'mensagem' => 'Erro ao deletar empréstimo',
                'error' => 's',
                'msg_erro' => $th->getMessage(),
            ], 500);
        }
    }
}
