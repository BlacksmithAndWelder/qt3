<?php

namespace App\Http\Controllers\Web\Suporte;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuporteTarefa\Request as SuporteTarefaRequest;
use App\Models\SuporteTarefa;
use App\Models\SuporteTarefaStatus;
use App\Models\User as Usuario;

class SuporteTarefaController extends Controller
{
    

    public function listar(){
        $listaSuporteTarefa = SuporteTarefa::with('usuario','status')->get();
        return view('suporte-tarefa.listar', compact('listaSuporteTarefa'));
    }
    public function criar(){
        $suporteTarefa = new SuporteTarefa();
        $listaUsuarios = Usuario::get();
        $listaSuporteTarefaStatus = SuporteTarefaStatus::get();
        return view('suporte-tarefa.criar',compact('suporteTarefa', 'listaSuporteTarefaStatus', 'listaUsuarios'));
    }
    public function salvar(SuporteTarefaRequest $request){
        try{
            
            $dados          = $request->validated();
            $usuario        = Usuario::find($dados['user_id']);
            $status         = SuporteTarefaStatus::find($dados['status_id']);
            $suporteTarefa  = array(
                'user_id'       => $usuario->id,
                'status_id'     => $status->id,
                'urgente'       => $dados['urgente'],
                'assunto'       => $dados['assunto'],
                'descricao'     => $dados['descricao'],
                'created_at'    => now(),
                'updated_at'    => now()
            );
            $suporteTarefa = SuporteTarefa::create($suporteTarefa);

            return redirect()
                    ->route('suporte-tarefa.listar')
                    ->with('classe', 'success')
                    ->with('mensagem', 'Cadastro realizado com sucesso!');
        } catch (\Throwable $th) {
            return redirect()
                ->route('suporte-tarefa.listar')
                ->with('classe', 'danger')
                ->with('mensagem', 'Não foi possível realizar o cadastro!');
        }
    }
    public function editar($id){
        try {
            $suporteTarefa              = SuporteTarefa::find($id);
            $listaUsuarios              = Usuario::get();
            $listaSuporteTarefaStatus   = SuporteTarefaStatus::get();
            
            return view('suporte-tarefa.editar', compact('suporteTarefa', 'listaSuporteTarefaStatus', 'listaUsuarios'));
        } catch (\Throwable $th) {
            report($th);
            return redirect()
                ->route('suporte-tarefa.listar')
                ->with('classe', 'danger')
                ->with('mensagem', 'Não foi possível localizar o cadastro!');
        }
    }
    public function atualizar(SuporteTarefaRequest $request, $id){
        try {
            $dados                      = $request->validated();
            $usuario                    = Usuario::find($dados['user_id']);
            $status                     = SuporteTarefaStatus::find($dados['status_id']);
            $suporteTarefa              = SuporteTarefa::find($id);
            $suporteTarefa->user_id     = $usuario->id;
            $suporteTarefa->status_id   = $status->id;
            $suporteTarefa->urgente     = $dados['urgente'];
            $suporteTarefa->assunto     = $dados['assunto'];
            $suporteTarefa->descricao   = $dados['descricao'];
            $suporteTarefa->updated_at  = now();
            $suporteTarefa->save();

            return redirect()
                ->route('suporte-tarefa.listar')
                ->with('classe', 'success')
                ->with('mensagem', 'Alteração realizada com sucesso!');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()
                ->route('suporte-tarefa.listar')
                ->with('classe', 'danger')
                ->with('mensagem', 'Não foi possível realizar a alteração!');
        }
    }
    public function excluir($id){
        try {
            /**
             * Verificar se possui tarefa antes de excluir
             */
            $suporteTarefa = SuporteTarefa::find($id);
            $suporteTarefa->delete();

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
