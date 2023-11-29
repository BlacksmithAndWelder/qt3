<?php

namespace App\Http\Controllers\Web\Turma;

use App\Http\Controllers\Controller;
use App\Http\Requests\Turma\Request as TurmaRequest;
use App\Models\Escola;
use App\Models\Turma;

class TurmaController extends Controller{
      
    public function listar(){
        $listaTurma = Turma::with('escola')->get();
        return view('turma.listar', compact('listaTurma'));
    }
    public function criar(){
        $turma          = new Turma();
        $listaEscolas   = Escola::get();
        return view('turma.criar',compact('turma', 'listaEscolas'));
    }
    public function salvar(TurmaRequest $request){
        try{
            
            $dados = $request->validated();
            $escola = Escola::find($dados['escola_id']);

            $turma = array(
                'escola_id'   => $escola->id,
                'ativo'       => $dados['ativo'] ? true : false,
                'equipe'      => $dados['equipe'],
                'sala'        => $dados['sala'],
            );
            $turma = Turma::create($turma);

            return redirect()
                    ->route('turma.listar')
                    ->with('classe', 'success')
                    ->with('mensagem', 'Cadastro realizado com sucesso!');
        } catch (\Throwable $th) {
            report($th);
            return redirect()
                ->route('turma.listar')
                ->with('classe', 'danger')
                ->with('mensagem', 'Não foi possível realizar o cadastro!');
        }
    }
    public function editar($id){
        try {
            $turma          = Turma::with('escola')->find($id);
            $listaEscolas   = Escola::get();
            
            return view('turma.editar', compact('turma', 'listaEscolas'));
        } catch (\Throwable $th) {
            report($th);
            return redirect()
                ->route('turma.listar')
                ->with('classe', 'danger')
                ->with('mensagem', 'Não foi possível localizar o cadastro!');
        }
    }
    public function atualizar(TurmaRequest $request, $id){
        try {
            $dados              = $request->validated();
            $turma              = Turma::find($id);
            $escola             = Escola::find($dados['escola_id']);

            $turma->escola_id   = $escola->id;
            $turma->ativo       = $dados['ativo'] ? true : false;
            $turma->equipe      = $dados['equipe'];
            $turma->sala        = $dados['sala'];
            $turma->save();

            return redirect()
                ->route('turma.listar')
                ->with('classe', 'success')
                ->with('mensagem', 'Alteração realizada com sucesso!');
        } catch (\Throwable $th) {
            report($th);
            return redirect()
                ->route('turma.listar')
                ->with('classe', 'danger')
                ->with('mensagem', 'Não foi possível realizar a alteração!');
        }
    }
    public function excluir($id){
        try {
            /**
             * Verificar se possui turma antes de excluir
             */
            $turma = Turma::find($id);
            $turma->delete();

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
