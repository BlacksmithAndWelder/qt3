<?php

namespace App\Http\Controllers\Web\Usuario;

use App\Http\Controllers\Controller;
use App\Models\User as Usuario;
use App\Http\Requests\Usuario\Request as UsuarioRequest;

class UsuarioController extends Controller
{
    

    public function listar(){
        $ListaUsuarios = Usuario::get();
        return view('usuario.listar', compact('ListaUsuarios'));
    }
    public function criar(){ 
        $Usuario = new Usuario();
        return view('usuario.criar',compact('Usuario'));
    }
    public function salvar(UsuarioRequest $request){
        try{
            
            $dados = $request->validated();
            $Usuario = array(
                'name'      => $dados['nome'],
                'password'  => $dados['senha'],
                'email'     => $dados['email']
            );
            $Usuario = Usuario::create($Usuario);

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
            $Usuario = Usuario::find($id);
            
            return view('usuario.editar', compact('Usuario'));
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
            $Usuario = Usuario::find($id);
            $Usuario->name = $dados['nome'];
            $Usuario->password = $dados['senha'];
            $Usuario->email = $dados['email'];
            $Usuario->save();

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
            $Usuario = Usuario::find($id);
            $Usuario->delete();

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
