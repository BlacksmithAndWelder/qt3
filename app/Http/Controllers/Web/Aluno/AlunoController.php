<?php

namespace App\Http\Controllers\Web\Aluno;

use App\Http\Controllers\Controller;
use App\Http\Requests\Aluno\Request as AlunoRequest;
use App\Models\Aluno;
use App\Models\Turma;

class AlunoController extends Controller{
     
    public function listar(){
        $ListaAluno = Aluno::get();
        return view('aluno.listar', compact('ListaAluno'));
    }
    
    public function criar(){ 
        $Aluno = new Aluno();
        $ListaTurma = Turma::where('ativo', true)->get(); 
        return view('aluno.criar',compact('Aluno', 'ListaTurma'));
    }

    public function salvar(AlunoRequest $request){
        try{
            
            $dados = $request->validated();
            $turma = Turma::find($dados['turma_id']);
            $aluno = array(
                'nome'          => $dados['nome'],
                'sobrenome'     => $dados['sobrenome'],
                'idade'         => $dados['idade'],
                'bolsa_estudos' => $dados['bolsa_estudos'],
                'turma_id'      => $turma->id,
            );
            $aluno = Aluno::create($aluno);

            return redirect()
                    ->route('aluno.listar')
                    ->with('classe', 'success')
                    ->with('mensagem', 'Cadastro realizado com sucesso!');
        } catch (\Throwable $th) {
            return redirect()
                ->route('aluno.listar')
                ->with('classe', 'danger')
                ->with('mensagem', 'Não foi possível realizar o cadastro!');
        }
    }
    public function editar($id){
        try {
            $Aluno = Aluno::with('turma', 'turma.escola')->find($id);
            $ListaTurma = Turma::where('ativo', true)->get(); 
            
            return view('aluno.editar', compact('Aluno', 'ListaTurma'));
        } catch (\Throwable $th) {
            report($th);
            return redirect()
                ->route('aluno.listar')
                ->with('classe', 'danger')
                ->with('mensagem', 'Não foi possível localizar o cadastro!');
        }
    }
    public function atualizar(AlunoRequest $request, $id){
        try {
            $dados = $request->validated();
            $aluno = Aluno::find($id);
            $turma = Turma::find($dados['turma_id']);

            $aluno->nome            = $dados['nome'];
            $aluno->sobrenome       = $dados['sobrenome'];
            $aluno->idade           = $dados['idade'];
            $aluno->bolsa_estudos   = $dados['bolsa_estudos'];
            $aluno->turma_id        = $turma->id;
            $aluno->save();

            return redirect()
                ->route('aluno.listar')
                ->with('classe', 'success')
                ->with('mensagem', 'Alteração realizada com sucesso!');
        } catch (\Throwable $th) {
            report($th);
            return redirect()
                ->route('aluno.listar')
                ->with('classe', 'danger')
                ->with('mensagem', 'Não foi possível realizar a alteração!');
        }
    }
    public function excluir($id){
        try {
            /**
             * Verificar se possui matrícula antes de excluir
             */
            $aluno = Aluno::find($id);
            $aluno->delete();

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
