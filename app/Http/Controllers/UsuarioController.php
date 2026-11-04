<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    public function salvar_usuario(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'nif' => 'required|string|max:255|unique:usuario,nif',
            'email' => 'required|email|max:255|unique:usuario,email',
            'senha' => 'required|string|min:6',
            'tipo_usuario' => 'required|string|max:255',
            'status' => 'sometimes|boolean',
            'data_nascimento' => 'nullable|date'
        ]);

        $dados['senha'] = Hash::make($dados['senha']);

        $usuario = Usuario::create($dados);

        return response()->json([
            'mensagem' => 'Usuário cadastrado com sucesso.',
            'usuario' => $usuario
        ], 201);
    }

    public function ver_usuario(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        $usuario = Usuario::findOrFail($request->id);

        return response()->json($usuario);
    }

    public function listar_usuarios()
    {
        return response()->json(
            Usuario::orderBy('id', 'desc')->get()
        );
    }

    public function listar_usuarios_simples()
    {
        return response()->json(
            Usuario::select('id', 'nome', 'nif', 'tipo_usuario', 'status')
                ->orderBy('nome')
                ->get()
        );
    }

    public function alterar_usuario(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:usuario,id'
        ]);

        $usuario = Usuario::findOrFail($request->id);

        $dados = $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'nif' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('usuario', 'nif')->ignore($usuario->id)
            ],
            'email' => [
                'sometimes',
                'required',
                'email',
                'max:255',
                Rule::unique('usuario', 'email')->ignore($usuario->id)
            ],
            'senha' => 'sometimes|nullable|string|min:6',
            'tipo_usuario' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|boolean',
            'data_nascimento' => 'sometimes|nullable|date'
        ]);

        if (!empty($dados['senha'])) {
            $dados['senha'] = Hash::make($dados['senha']);
        } else {
            unset($dados['senha']);
        }

        $usuario->update($dados);

        return response()->json([
            'mensagem' => 'Usuário atualizado com sucesso.',
            'usuario' => $usuario->fresh()
        ]);
    }

    public function deletar_usuario(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:usuario,id'
        ]);

        Usuario::findOrFail($request->id)->delete();

        return response()->json([
            'mensagem' => 'Usuário excluído com sucesso.'
        ]);
    }
}
