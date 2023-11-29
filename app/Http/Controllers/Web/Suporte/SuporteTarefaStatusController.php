<?php

namespace App\Http\Controllers\Web\Suporte;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuporteTarefaStatus\Request as SuporteTarefaStatusRequest;
use App\Models\SuporteTarefaStatus;

class SuporteTarefaStatusController extends Controller
{
    

    public function listar(){
        $ListaSuporteTarefaStatus = SuporteTarefaStatus::get();
        return view('suporte-tarefa-status.listar', compact('ListaSuporteTarefaStatus'));
    }
    public function criar(){ 
        $SuporteTarefaStatus = new SuporteTarefaStatus();
        return view('suporte-tarefa-status.criar',compact('SuporteTarefaStatus'));
    }
    public function salvar(SuporteTarefaStatusRequest $request){
        try{
            
            $dados = $request->validated();
            $SuporteTarefaStatus = array(
                'nome' => $dados['nome']
            );
            $SuporteTarefaStatus = SuporteTarefaStatus::create($SuporteTarefaStatus);

            return redirect()
                    ->route('suporte-tarefa-status.listar')
                    ->with('classe', 'success')
                    ->with('mensagem', 'Cadastro realizado com sucesso!');
        } catch (\Throwable $th) {
            return redirect()
                ->route('suporte-tarefa-status.listar')
                ->with('classe', 'danger')
                ->with('mensagem', 'Não foi possível realizar o cadastro!');
        }
    }
    public function editar($id){
        try {
            $SuporteTarefaStatus = SuporteTarefaStatus::find($id);
            
            return view('suporte-tarefa-status.editar', compact('SuporteTarefaStatus'));
        } catch (\Throwable $th) {
            report($th);
            return redirect()
                ->route('suporte-tarefa-status.listar')
                ->with('classe', 'danger')
                ->with('mensagem', 'Não foi possível localizar o cadastro!');
        }
    }
    public function atualizar(SuporteTarefaStatusRequest $request, $id){
        try {
            $dados = $request->validated();
            $SuporteTarefaStatus = SuporteTarefaStatus::find($id);
            $SuporteTarefaStatus->nome = $dados['nome'];
            $SuporteTarefaStatus->save();

            return redirect()
                ->route('suporte-tarefa-status.listar')
                ->with('classe', 'success')
                ->with('mensagem', 'Alteração realizada com sucesso!');
        } catch (\Throwable $th) {
            report($th);
            return redirect()
                ->route('suporte-tarefa-status.listar')
                ->with('classe', 'danger')
                ->with('mensagem', 'Não foi possível realizar a alteração!');
        }
    }
    public function excluir($id){
        try {
            /**
             * Verificar se possui status antes de excluir
             */
            $SuporteTarefaStatus = SuporteTarefaStatus::find($id);
            $SuporteTarefaStatus->delete();

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
