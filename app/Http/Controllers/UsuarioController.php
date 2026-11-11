<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use App\Models\UsuarioToken;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    public function usuario_html(Request $request)
    {
        return view('loginteste');
    }

    public function cadastrar_usuario(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'nif' => 'required|string|unique:usuario,nif',
            'email' => 'required|email|unique:usuario,email',
            'senha' => 'required|string|min:8',
            'tipo_usuario' => 'required|in:Aluno,Admin,Funcionario',
        ]);

        try {
            $usuario = new Usuario();
            $usuario->nome = $dados['nome'];
            $usuario->nif = $dados['nif'];
            $usuario->email = $dados['email'];
            $usuario->senha = Hash::make($dados['senha']);
            $usuario->tipo_usuario = $dados['tipo_usuario'];
            $usuario->save();

            return response()->json([
                'message' => 'Usuário cadastrado com sucesso!',
                'usuario' => $usuario,
                'erro' => 'n'
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao cadastrar usuário',
                'erro' => 's',
                'msg_erro' => $th->getMessage()
            ], 500);
        }
    }

    public function ver_usuario(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        $usuario = Usuario::find($request->id);

        if (!$usuario) {
            return response()->json([
                'message' => 'Usuário não encontrado',
                'erro' => 's'
            ], 404);
        }

        return response()->json([
            'usuario' => $usuario,
            'erro' => 'n'
        ], 200);
    }

    public function listar_usuarios(Request $request)
    {
        $usuarios = Usuario::all();

        return response()->json([
            'usuarios' => $usuarios,
            'erro' => 'n'
        ], 200);
    }

    public function listar_usuarios_simples(Request $request)
    {
        $usuarios = Usuario::select('id', 'nome', 'tipo_usuario')->get();

        return response()->json([
            'usuarios' => $usuarios,
            'erro' => 'n'
        ], 200);
    }

    public function alterar_usuario(Request $request)
    {
        $dados = $request->validate([
            'id' => 'required|integer|exists:usuario,id',
            'nome' => 'required|string|max:255',
            'nif' => ['required', 'string', Rule::unique('usuario', 'nif')->ignore($request->id)],
            'email' => ['required', 'email', Rule::unique('usuario', 'email')->ignore($request->id)],
            'senha' => 'nullable|string|min:8',
            'tipo_usuario' => 'required|in:Aluno,Admin,Funcionario',
        ]);

        try {
            $usuario = Usuario::findOrFail($dados['id']);

            $usuario->nome = $dados['nome'];
            $usuario->nif = $dados['nif'];
            $usuario->email = $dados['email'];
            $usuario->tipo_usuario = $dados['tipo_usuario'];

            if (!empty($dados['senha'])) {
                $usuario->senha = Hash::make($dados['senha']);
            }

            $usuario->save();

            return response()->json([
                'message' => 'Usuário alterado com sucesso!',
                'erro' => 'n'
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao alterar usuário',
                'erro' => 's',
                'msg_erro' => $th->getMessage()
            ], 500);
        }
    }

    public function deletar_usuario(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:usuario,id'
        ]);

        try {
            $usuario = Usuario::findOrFail($request->id);
            $usuario->delete();

            return response()->json([
                'message' => 'Usuário deletado com sucesso!',
                'erro' => 'n'
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao deletar usuário',
                'erro' => 's',
                'msg_erro' => $th->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required'
        ]);

        $usuario = Usuario::where('email', $request->email)->first();

        if (!$usuario || !Hash::check($request->senha, $usuario->senha)) {
            return response()->json([
                'message' => 'Email ou senha incorretos',
                'erro' => 's'
            ], 401);
        }

        $usuario_token = new UsuarioToken();
        $usuario_token->usuario_id = $usuario->id;
        $usuario_token->token = Hash::make($usuario->id . $usuario->email . now());
        $usuario_token->valido_ate = now()->addDays(7);
        $usuario_token->save();

        return response()->json([
            'message' => 'Login realizado com sucesso',
            'erro' => 'n',
            'usuario' => $usuario,
            'token' => $usuario_token->token,
            'usuario_id' => $usuario->id
        ], 200);
    }

    public function logout_u(Request $request)
    {
        $request->validate([
            'token' => 'required'
        ]);

        try {
            $usuario_token = UsuarioToken::where('token', $request->token)->first();

            if (!$usuario_token) {
                return response()->json([
                    'message' => 'Token inválido',
                    'erro' => 's'
                ], 401);
            }

            $usuario_token->delete();

            return response()->json([
                'message' => 'Logout realizado com sucesso',
                'erro' => 'n'
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao realizar logout',
                'erro' => 's',
                'msg_erro' => $th->getMessage()
            ], 500);
        }
    }
}
