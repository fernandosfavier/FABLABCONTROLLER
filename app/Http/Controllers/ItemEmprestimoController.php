<?php

namespace App\Http\Controllers;

use App\Models\ItemEmprestimo;
use Illuminate\Http\Request;

class ItemEmprestimoController extends Controller
{
    public function cadastro_html()
    {
        return view('cadastro_item_emprestimo');
    }

    public function salvar_item_emprestimo(Request $request)
    {
        $request->validate([
            'emprestimo_id' => 'required|integer|exists:emprestimo,id',
            'equipamento_id' => 'required|integer|exists:equipamento,id',
            'estado_retirada' => 'nullable|string|max:255',
            'estado_devolucao' => 'nullable|string|max:255',
            'observacao' => 'nullable|string',
        ]);

        try {

            $item = new ItemEmprestimo();

            $item->emprestimo_id = $request->emprestimo_id;
            $item->equipamento_id = $request->equipamento_id;
            $item->estado_retirada = $request->estado_retirada;
            $item->estado_devolucao = $request->estado_devolucao;
            $item->observacao = $request->observacao;

            $item->save();

            return response()->json([
                'mensagem' => 'Item do empréstimo cadastrado com sucesso!',
                'error' => 'n',
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'mensagem' => 'Erro ao cadastrar item do empréstimo',
                'error' => 's',
                'msg_erro' => $th->getMessage(),
            ], 500);
        }
    }

    public function ver_item_emprestimo(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:item_emprestimo,id',
        ]);

        $item = ItemEmprestimo::find($request->id);

        if ($item) {

            return response()->json([
                'mensagem' => 'Item do empréstimo encontrado com sucesso!',
                'error' => 'n',
                'item_emprestimo' => $item,
            ], 200);

        } else {

            return response()->json([
                'mensagem' => 'Item do empréstimo não encontrado',
                'error' => 's',
            ], 200);
        }
    }

    public function listar_itens_emprestimo()
    {
        $itens = ItemEmprestimo::all();

        return response()->json([
            'itens_emprestimo' => $itens,
        ], 200);
    }

    public function listar_itens_emprestimo_simples()
    {
        $itens = ItemEmprestimo::select(
            'emprestimo_id',
            'equipamento_id',
            'estado_retirada',
            'estado_devolucao'
        )->get();

        return response()->json([
            'itens_emprestimo' => $itens,
        ], 200);
    }

    public function alterar_item_emprestimo(Request $request)
    {
        try {

            $item = ItemEmprestimo::find($request->id);

            if (!$item) {

                return response()->json([
                    'mensagem' => 'Item do empréstimo não encontrado',
                    'error' => 's',
                ], 200);
            }

            $item->emprestimo_id = $request->emprestimo_id;
            $item->equipamento_id = $request->equipamento_id;
            $item->estado_retirada = $request->estado_retirada;
            $item->estado_devolucao = $request->estado_devolucao;
            $item->observacao = $request->observacao;

            $item->save();

            return response()->json([
                'mensagem' => 'Item do empréstimo alterado com sucesso!',
                'error' => 'n',
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'mensagem' => 'Erro ao alterar item do empréstimo',
                'error' => 's',
                'msg_erro' => $th->getMessage(),
            ], 500);
        }
    }

    public function deletar_item_emprestimo(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:item_emprestimo,id',
        ]);

        try {

            $item = ItemEmprestimo::find($request->id);

            $item->delete();

            return response()->json([
                'mensagem' => 'Item do empréstimo deletado com sucesso!',
                'error' => 'n',
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'mensagem' => 'Erro ao deletar item do empréstimo',
                'error' => 's',
                'msg_erro' => $th->getMessage(),
            ], 500);
        }
    }
}
