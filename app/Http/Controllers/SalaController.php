<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    public function cadastro_html()
    {
        return view('cadastro_sala');
    }

    public function salvar_sala(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'bloco' => 'nullable|string|max:255',
            'observacao' => 'nullable|string',
        ]);

        try {

            $sala = new Sala();

            $sala->nome = $request->nome;
            $sala->bloco = $request->bloco;
            $sala->observacao = $request->observacao;

            $sala->save();

            return response()->json([
                'mensagem' => 'Sala cadastrada com sucesso!',
                'error' => 'n',
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'mensagem' => 'Erro ao cadastrar sala',
                'error' => 's',
                'msg_erro' => $th->getMessage(),
            ], 500);
        }
    }

    public function ver_sala(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        $sala = Sala::find($request->id);

        if ($sala) {

            return response()->json([
                'mensagem' => 'Sala encontrada com sucesso!',
                'error' => 'n',
                'sala' => $sala,
            ], 200);

        } else {

            return response()->json([
                'mensagem' => 'Sala não encontrada',
                'error' => 's',
            ], 200);
        }
    }

    public function listar_salas()
    {
        $salas = Sala::all();

        return response()->json([
            'salas' => $salas,
        ], 200);
    }

    public function listar_salas_simples()
    {
        $salas = Sala::select(
            'nome',
            'bloco'
        )->get();

        return response()->json([
            'salas' => $salas,
        ], 200);
    }

    public function alterar_sala(Request $request)
    {
        try {

            $sala = Sala::find($request->id);

            if (!$sala) {

                return response()->json([
                    'mensagem' => 'Sala não encontrada',
                    'error' => 's',
                ], 200);
            }

            $sala->nome = $request->nome;
            $sala->bloco = $request->bloco;
            $sala->observacao = $request->observacao;

            $sala->save();

            return response()->json([
                'mensagem' => 'Sala alterada com sucesso!',
                'error' => 'n',
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'mensagem' => 'Erro ao alterar sala',
                'error' => 's',
                'msg_erro' => $th->getMessage(),
            ], 500);
        }
    }

    public function deletar_sala(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:sala,id',
        ]);

        try {

            $sala = Sala::find($request->id);

            $sala->delete();

            return response()->json([
                'mensagem' => 'Sala deletada com sucesso!',
                'error' => 'n',
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'mensagem' => 'Erro ao deletar sala',
                'error' => 's',
                'msg_erro' => $th->getMessage(),
            ], 500);
        }
    }
}
