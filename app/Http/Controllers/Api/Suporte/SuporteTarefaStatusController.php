<?php

namespace App\Http\Controllers\Web\Suporte;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuporteTarefaStatus\Request as SuporteTarefaStatusRequest;
use App\Models\SuporteTarefaStatus;

class SuporteTarefaStatusController extends Controller
{
    

    public function listar(){
        $listaSuporteTarefaStatus = SuporteTarefaStatus::get();
        return view('suporte-tarefa-status.listar', compact('listaSuporteTarefaStatus'));
    }
    public function criar(){ 
        $suporteTarefaStatus = new SuporteTarefaStatus();
        return view('suporte-tarefa-status.criar',compact('suporteTarefaStatus'));
    }
    public function salvar(SuporteTarefaStatusRequest $request){
        try{
            
            $dados = $request->validated();
            $suporteTarefaStatus = array(
                'nome' => $dados['nome']
            );
            $suporteTarefaStatus = SuporteTarefaStatus::create($suporteTarefaStatus);

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
            $suporteTarefaStatus = SuporteTarefaStatus::find($id);
            
            return view('suporte-tarefa-status.editar', compact('suporteTarefaStatus'));
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
            $suporteTarefaStatus = SuporteTarefaStatus::find($id);
            $suporteTarefaStatus->nome = $dados['nome'];
            $suporteTarefaStatus->save();

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
            $suporteTarefaStatus = SuporteTarefaStatus::find($id);
            $suporteTarefaStatus->delete();

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
