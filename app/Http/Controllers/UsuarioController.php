<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use App\Models\UsuarioToken;

class UsuarioController extends Controller
{
    Public function usuario_html(Request $request)
    {
        return view('Usuario');
    }
    
    public function cadastrarUsuario(Request $request){

        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuario',
            'senha' => 'required|string|min:8',
            'tipo' => 'required|in:Aluno,Funcionario',
        ]);

        try {

            $usuario = new Usuario();
            $usuario->nome = $request->nome;
            $usuario->email = $request->email;
            $usuario->senha = Hash::make($request->senha);
            $usuario->tipo = $request->tipo;
            $usuario->save();

            return response()->json(['message' => 'Usuário cadastrado com sucesso!','erro' =>'n'], 200);


        }catch (\Throwable $th) {
            
            return response()->json(['message' => 'Erro ao cadastrar usuário', 'erro' => 's', 'msg_erro' => $th->getMessage()], 200);
        }

    }

    public function ver_usuario(Request $request){
        $request->validate([
            'id' => 'required|integer|',
        ]);
        $usuario = Usuario::find($request->id);
        $usuario ->login_funcionario;
        if ($usuario) {
            return response()->json(['usuario' => $usuario, 'erro' => 'n'], 200);
            } else {
            return response()->json(['message' => 'Usuário não encontrado', 'erro' => 's'], 200);
            }
    }
    public function listar_usuarios(Request $request){
        $usuarios = Usuario::all();
        $usuarios->load('login_funcionario');
        return response()->json(['usuarios' => $usuarios, 'erro' => 'n'], 200);
    }
     public function listar_usuarios_simples(Request $request){
        $usuarios = Usuario::select('nome', 'tipo')->get();
        return response()->json(['usuarios' => $usuarios, 'erro' => 'n'], 200);
    }
    
    public function alterar_usuario(Request $request){

            $request->validate([
                'id' => 'required|integer|exists:usuario,id',
                'nome' => 'required|string|max:255',
                'email' => 'required|email',
                'senha' => 'required|string|min:8',
                'tipo' => 'required|in:Aluno,Funcionario',
            ]);

            try {

                $usuario = Usuario::find($request->id);
                
                if($usuario->email != $request->cpf){
                    $usuario_email_igual = Usuario::where('email', $request->email)->first();
                    if($usuario_email_igual){
                        return response()->json(['message' => 'Email já cadastrado', 'erro' => 's'], 200);
                    }
                }
                $usuario->nome = $request->nome;
                $usuario->email = $request->email;
                $usuario->senha = Hash::make($request->senha);
                $usuario->tipo = $request->tipo;
                $usuario->save();

                return response()->json(['message' => 'Usuário alterado com sucesso!','erro' =>'n'], 200);


            }catch (\Throwable $th) {
                
                return response()->json(['message' => 'Erro ao cadastrar usuário', 'erro' => 's', 'msg_erro' => $th->getMessage()], 200);
            }

        }

        public function deletar_usuario(Request $request){
            $request->validate([
                'id' => 'required|integer|exists:usuario,id',
            ]);
            try {
                $usuario = Usuario::find($request->id);
                $usuario->delete();
                return response()->json(['message' => 'Usuário deletado com sucesso!', 'erro' => 'n'], 200);
            } catch (\Throwable $th) {
                return response()->json(['message' => 'Erro ao deletar usuário', 'erro' => 's', 'msg_erro' => $th->getMessage()], 200);
            }
        }

        public function login(Request $request){
            $request->validate([
                'email' => 'required',
                'senha' => 'required',
            ]);

                $usuario = Usuario::where('email', $request->email)->first();
                if($usuario){
                    
                    if(Hash::check($request->senha, $usuario->senha)){
                        $usuario_token  = new UsuarioToken();
                        $usuario_token->usuario_id = $usuario->id;
                        $usuario_token->token = Hash::make( $usuario->id  . $usuario->email . now());
                        $usuario_token->valido_ate = now()->addDays(7);
                        $usuario_token->save();
                        return response()->json(['message' => 'Login realizado com sucesso', 'erro' => 'n', 'usuario' => $usuario, 'token' => $usuario_token->token, "usuario_id" => $usuario->id], 200);
                    }else{
                        return response()->json(['message' => 'Email ou senha incorretos', 'erro' => 's'], 200);
                    }
                }else{
                    return response()->json(['message' => 'Email ou senha incorretos', 'erro' => 's'], 200);
                }
            }

            public function logout_u(Request $request){
                $request->validate([
                    'token' => 'required',
                ]);
                try {
                    $usuario_token = UsuarioToken::where('token', $request->token)->first();
                    if($usuario_token){
                        $usuario_token->delete();
                        return response()->json(['message' => 'Logout realizado com sucesso', 'erro' => 'n'], 200);
                    }else{
                        return response()->json(['message' => 'Token inválido', 'erro' => 's'], 200);
                    }
                } catch (\Throwable $th) {
                    return response()->json(['message' => 'Erro ao realizar logout', 'erro' => 's', 'msg_erro' => $th->getMessage()], 200);
                }
            }
        
    
}


