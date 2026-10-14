<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function cadastro_html()
    {
        return view('cadastro_usuario');
    }

    public function salvar_usuario(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'nif' => 'required|string|max:255|unique:usuario,nif',
            'email' => 'required|email|max:255|unique:usuario,email',
            'senha' => 'required|string|min:6',
            'tipo_usuario' => 'required|string|max:255',
            'status' => 'required',
            'data_nascimento' => 'nullable|date',
        ]);

        try {

            $usuario = new Usuario();

            $usuario->nome = $request->nome;
            $usuario->nif = $request->nif;
            $usuario->email = $request->email;
            $usuario->senha = Hash::make($request->senha);
            $usuario->tipo_usuario = $request->tipo_usuario;
            $usuario->status = $request->status;
            $usuario->data_nascimento = $request->data_nascimento;

            $usuario->save();

            return response()->json([
                'mensagem' => 'Usuário cadastrado com sucesso!',
                'error' => 'n',
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'mensagem' => 'Erro ao cadastrar usuário',
                'error' => 's',
                'msg_erro' => $th->getMessage(),
            ], 500);
        }
    }

    public function ver_usuario(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:usuario,id',
        ]);

        $usuario = Usuario::find($request->id);

        if ($usuario) {

            return response()->json([
                'mensagem' => 'Usuário encontrado com sucesso!',
                'error' => 'n',
                'usuario' => $usuario,
            ], 200);

        } else {

            return response()->json([
                'mensagem' => 'Usuário não encontrado',
                'error' => 's',
            ], 200);
        }
    }

    public function listar_usuarios()
    {
        $usuarios = Usuario::all();

        return response()->json([
            'usuarios' => $usuarios,
        ], 200);
    }

    public function listar_usuarios_simples()
    {
        $usuarios = Usuario::select(
            'nome',
            'nif',
            'email',
            'tipo_usuario',
            'status'
        )->get();

        return response()->json([
            'usuarios' => $usuarios,
        ], 200);
    }

    public function alterar_usuario(Request $request)
    {
        try {

            $usuario = Usuario::find($request->id);

            if (!$usuario) {

                return response()->json([
                    'mensagem' => 'Usuário não encontrado',
                    'error' => 's',
                ], 200);
            }

            if ($usuario->nif != $request->nif) {

                $usuario_nif_igual = Usuario::where(
                    'nif',
                    $request->nif
                )->first();

                if ($usuario_nif_igual) {

                    return response()->json([
                        'mensagem' => 'NIF já cadastrado para outro usuário',
                        'error' => 's',
                    ], 200);
                }
            }

            if ($usuario->email != $request->email) {

                $usuario_email_igual = Usuario::where(
                    'email',
                    $request->email
                )->first();

                if ($usuario_email_igual) {

                    return response()->json([
                        'mensagem' => 'Email já cadastrado para outro usuário',
                        'error' => 's',
                    ], 200);
                }
            }

            $usuario->nome = $request->nome;
            $usuario->nif = $request->nif;
            $usuario->email = $request->email;

            if ($request->senha) {
                $usuario->senha = Hash::make($request->senha);
            }

            $usuario->tipo_usuario = $request->tipo_usuario;
            $usuario->status = $request->status;
            $usuario->data_nascimento = $request->data_nascimento;

            $usuario->save();

            return response()->json([
                'mensagem' => 'Usuário alterado com sucesso!',
                'error' => 'n',
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'mensagem' => 'Erro ao alterar usuário',
                'error' => 's',
                'msg_erro' => $th->getMessage(),
            ], 500);
        }
    }

    public function deletar_usuario(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:usuario,id',
        ]);

        try {

            $usuario = Usuario::find($request->id);

            $usuario->delete();

            return response()->json([
                'mensagem' => 'Usuário deletado com sucesso!',
                'error' => 'n',
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'mensagem' => 'Erro ao deletar usuário',
                'error' => 's',
                'msg_erro' => $th->getMessage(),
            ], 500);
        }
    }
}
