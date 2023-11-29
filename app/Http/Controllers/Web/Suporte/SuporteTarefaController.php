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
        $ListaSuporteTarefa = SuporteTarefa::with('usuario','status')->get();
        return view('suporte-tarefa.listar', compact('ListaSuporteTarefa'));
    }
    public function criar(){ 
        $SuporteTarefa = new SuporteTarefa();
        $ListaUsuarios = Usuario::get();
        $ListaSuporteTarefaStatus = SuporteTarefaStatus::get();
        return view('suporte-tarefa.criar',compact('SuporteTarefa', 'ListaSuporteTarefaStatus', 'ListaUsuarios'));
    }
    public function salvar(SuporteTarefaRequest $request){
        try{
            
            $dados          = $request->validated();
            $usuario        = Usuario::find($dados['user_id']);
            $status         = SuporteTarefaStatus::find($dados['status_id']);
            $SuporteTarefa  = array(
                'user_id'       => $usuario->id,
                'status_id'     => $status->id,
                'urgente'       => $dados['urgente'],
                'assunto'       => $dados['assunto'],
                'descricao'     => $dados['descricao'],
                'created_at'    => now(),
                'updated_at'    => now()
            );
            $SuporteTarefa = SuporteTarefa::create($SuporteTarefa);

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
            $SuporteTarefa              = SuporteTarefa::find($id);
            $ListaUsuarios              = Usuario::get();
            $ListaSuporteTarefaStatus   = SuporteTarefaStatus::get();
            
            return view('suporte-tarefa.editar', compact('SuporteTarefa', 'ListaSuporteTarefaStatus', 'ListaUsuarios'));
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
            $SuporteTarefa              = SuporteTarefa::find($id);
            $SuporteTarefa->user_id     = $usuario->id;
            $SuporteTarefa->status_id   = $status->id;
            $SuporteTarefa->urgente     = $dados['urgente'];
            $SuporteTarefa->assunto     = $dados['assunto'];
            $SuporteTarefa->descricao   = $dados['descricao'];
            $SuporteTarefa->updated_at  = now();
            $SuporteTarefa->save();

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
            $SuporteTarefa = SuporteTarefa::find($id);
            $SuporteTarefa->delete();

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