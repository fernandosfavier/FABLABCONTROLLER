<?php

namespace App\Http\Controllers;

use App\Models\Equipamento;
use Illuminate\Http\Request;

class EquipamentoController extends Controller
{
    public function cadastro_html()
    {
        return view('cadastro_equipamento');
    }

    public function salvar_equipamento(Request $request)
    {
        $request->validate([
            'patrimonio' => 'required|string|max:255|unique:equipamento,patrimonio',
            'nome' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'modelo' => 'nullable|string|max:255',
            'status' => 'required|string|max:255',
            'observacao' => 'nullable|string',
        ]);

        try {
            $equipamento = new Equipamento();

            $equipamento->patrimonio = $request->patrimonio;
            $equipamento->nome = $request->nome;
            $equipamento->tipo = $request->tipo;
            $equipamento->modelo = $request->modelo;
            $equipamento->status = $request->status;
            $equipamento->observacao = $request->observacao;

            $equipamento->save();

            return response()->json([
                'mensagem' => 'Equipamento cadastrado com sucesso!',
                'error' => 'n',
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'mensagem' => 'Erro ao cadastrar equipamento',
                'error' => 's',
                'msg_erro' => $th->getMessage(),
            ], 500);
        }
    }

    public function ver_equipamento(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        $equipamento = Equipamento::find($request->id);

        if ($equipamento) {

            return response()->json([
                'mensagem' => 'Equipamento encontrado com sucesso!',
                'error' => 'n',
                'equipamento' => $equipamento,
            ], 200);

        } else {

            return response()->json([
                'mensagem' => 'Equipamento não encontrado',
                'error' => 's',
            ], 200);
        }
    }

    public function listar_equipamentos()
    {
        $equipamentos = Equipamento::all();

        return response()->json([
            'equipamentos' => $equipamentos,
        ], 200);
    }

    public function listar_equipamentos_simples()
    {
        $equipamentos = Equipamento::select(
            'patrimonio',
            'nome',
            'tipo',
            'modelo',
            'status'
        )->get();

        return response()->json([
            'equipamentos' => $equipamentos,
        ], 200);
    }

    public function alterar_equipamento(Request $request)
    {
        try {

            $equipamento = Equipamento::find($request->id);

            if (!$equipamento) {
                return response()->json([
                    'mensagem' => 'Equipamento não encontrado',
                    'error' => 's',
                ], 200);
            }

            if ($equipamento->patrimonio != $request->patrimonio) {

                $equipamento_patrimonio_igual = Equipamento::where(
                    'patrimonio',
                    $request->patrimonio
                )->first();

                if ($equipamento_patrimonio_igual) {

                    return response()->json([
                        'mensagem' => 'Patrimônio já cadastrado para outro equipamento',
                        'error' => 's',
                    ], 200);
                }
            }

            $equipamento->patrimonio = $request->patrimonio;
            $equipamento->nome = $request->nome;
            $equipamento->tipo = $request->tipo;
            $equipamento->modelo = $request->modelo;
            $equipamento->status = $request->status;
            $equipamento->observacao = $request->observacao;

            $equipamento->save();

            return response()->json([
                'mensagem' => 'Equipamento alterado com sucesso!',
                'error' => 'n',
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'mensagem' => 'Erro ao alterar equipamento',
                'error' => 's',
                'msg_erro' => $th->getMessage(),
            ], 500);
        }
    }

    public function deletar_equipamento(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:equipamento,id',
        ]);

        try {

            $equipamento = Equipamento::find($request->id);

            $equipamento->delete();

            return response()->json([
                'mensagem' => 'Equipamento deletado com sucesso!',
                'error' => 'n',
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'mensagem' => 'Erro ao deletar equipamento',
                'error' => 's',
                'msg_erro' => $th->getMessage(),
            ], 500);
        }
    }
}