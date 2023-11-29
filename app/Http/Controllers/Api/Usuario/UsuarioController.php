<?php

namespace App\Http\Controllers\Web\Usuario;

use App\Http\Controllers\Controller;
use App\Models\User as Usuario;
use App\Http\Requests\Usuario\Request as UsuarioRequest;

class UsuarioController extends Controller
{
    

    public function listar(){
        $listaUsuarios = Usuario::get();
        return view('usuario.listar', compact('listaUsuarios'));
    }
    public function criar(){
        $usuario = new Usuario();
        return view('usuario.criar',compact('usuario'));
    }
    public function salvar(UsuarioRequest $request){
        try{
            
            $dados = $request->validated();
            $usuario = array(
                'name'      => $dados['nome'],
                'password'  => $dados['senha'],
                'email'     => $dados['email']
            );
            $usuario = Usuario::create($usuario);

            return redirect()
                    ->route('usuario.listar')
                    ->with('classe', 'success')
                    ->with('mensagem', 'Cadastro realizado com sucesso!');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()
                ->route('usuario.listar')
                ->with('classe', 'danger')
                ->with('mensagem', 'Não foi possível realizar o cadastro!');
        }
    }
    public function editar($id){
        try {
            $usuario = Usuario::find($id);
            
            return view('usuario.editar', compact('usuario'));
        } catch (\Throwable $th) {
            report($th);
            return redirect()
                ->route('usuario.listar')
                ->with('classe', 'danger')
                ->with('mensagem', 'Não foi possível localizar o cadastro!');
        }
    }
    public function atualizar(UsuarioRequest $request, $id){
        try {
            $dados = $request->validated();
            $usuario = Usuario::find($id);
            $usuario->name = $dados['nome'];
            $usuario->password = $dados['senha'];
            $usuario->email = $dados['email'];
            $usuario->save();

            return redirect()
                ->route('usuario.listar')
                ->with('classe', 'success')
                ->with('mensagem', 'Alteração realizada com sucesso!');
        } catch (\Throwable $th) {
            report($th);
            return redirect()
                ->route('usuario.listar')
                ->with('classe', 'danger')
                ->with('mensagem', 'Não foi possível realizar a alteração!');
        }
    }
    public function excluir($id){
        try {
            /**
             * Verificar se possui matrícula antes de excluir
             */
            $usuario = Usuario::find($id);
            $usuario->delete();

            return back()
                ->with('classe', 'success')
                ->with('mensagem', 'Exclusão realizada com sucesso!');
        } catch (\Throwable $th) {
            report($th);
            return back()
                ->with('classe', 'danger')
                ->with('mensagem', 'Não foi possível excluir!');
        }
    }
}
