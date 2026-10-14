<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FuncionarioController extends Controller
{
    public function cadastro_html()
    {
        return view('cadastro_funcionario');
    }

    public function salvar_funcionario(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'nif' => 'required|string|max:255|unique:funcionario,nif',
            'email' => 'required|email|max:255|unique:funcionario,email',
            'senha' => 'required|string|min:6',
            'tipo_usuario' => 'required|string|max:255',
            'status' => 'required',
            'data_nascimento' => 'nullable|date',
        ]);

        try {
            $funcionario = new Funcionario();

            $funcionario->nome = $request->nome;
            $funcionario->nif = $request->nif;
            $funcionario->email = $request->email;
            $funcionario->senha = Hash::make($request->senha);
            $funcionario->tipo_usuario = $request->tipo_usuario;
            $funcionario->status = $request->status;
            $funcionario->data_nascimento = $request->data_nascimento;

            $funcionario->save();



            return response()->json([
                'mensagem' => 'Funcionário cadastrado com sucesso!',
                'error' => 'n',
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'mensagem' => 'Erro ao cadastrar funcionário',
                'error' => 's',
                'msg_erro' => $th->getMessage(),
            ], 500);
        }
    }

    public function ver_funcionario(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        $funcionario = Funcionario::find($request->id);
     
        if ($funcionario) {

         return   response()->json([
                'mensagem' => 'Funcionário encontrado com sucesso!',
                'error' => 'n',
                'funcionario' => $funcionario,
            ], 200);
        } else {
            return response()->json([
                'mensagem' => 'Funcionário não encontrado',
                'error' => 's',
            ], 200);
        }

    }
    public function listar_funcionarios()
    {
        $funcionarios = Funcionario::all();

        return response()->json([
            'funcionarios' => $funcionarios,
        ], 200);
    }

    public function listar_funcionarios_simples()
    {
        $funcionarios = Funcionario::select('nome', 'nif', 'email')
            ->get();

        return response()->json([
            'funcionarios' => $funcionarios,
        ], 200);
    }

    public function alterar_funcionario(Request $request){
   

        try {
            $funcionario = Funcionario::find($request->id);

            if($funcionario->nif != $request->nif){
                $funci_nif_igual = Funcionario::where('nif', $request->nif)->first();
                if($funci_nif_igual){
                    return response()->json(['mensagem' => 'NIF já cadastrado para outro funcionário', 'error' => 's'], 200);
                }
            }

            if($funcionario->email != $request->email){
                $funci_email_igual = Funcionario::where('email', $request->email)->first();
                if($funci_email_igual){
                    return response()->json(['mensagem' => 'Email já cadastrado para outro funcionário', 'error' => 's'], 200);
                }
            }

            $funcionario->nome = $request->nome;
            $funcionario->nif = $request->nif;
            $funcionario->email = $request->email;
            $funcionario->senha = Hash::make($request->senha);
            $funcionario->tipo_usuario = $request->tipo_usuario;
            $funcionario->status = $request->status;
            $funcionario->data_nascimento = $request->data_nascimento;

            $funcionario->save();

            return response()->json(['mensagem' => 'Funcionário alterado com sucesso!','error' => 'n'], 200);
        } catch (\Throwable $th) {
            return response()->json(['mensagem' => 'Erro ao alterar funcionário', 'error' => 's', 'msg_erro' => $th->getMessage()], 200);
        }

    }

    public function deletar_funcionario(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:funcionario,id',
        ]);

        try {
            $funcionario = Funcionario::find($request->id);
            $funcionario->delete();

            return response()->json([
                'mensagem' => 'Funcionário deletado com sucesso!',
                'error' => 'n',
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'mensagem' => 'Erro ao deletar funcionário',
                'error' => 's',
                'msg_erro' => $th->getMessage(),
            ], 500);
        }
    }

}
