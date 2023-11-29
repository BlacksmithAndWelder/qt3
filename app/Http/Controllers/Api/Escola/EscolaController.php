<?php

namespace App\Http\Controllers\Web\Escola;

use App\Http\Controllers\Controller;
use App\Http\Requests\Escola\Request as EscolaRequest;
use App\Models\Escola;

class EscolaController extends Controller{
      
    public function listar(){
        $listaEscola = Escola::get();
        return view('escola.listar', compact('listaEscola'));
    }
    public function criar(){
        $escola = new Escola();
        return view('escola.criar',compact('escola'));
    }
    public function salvar(EscolaRequest $request){
        try{
            
            $dados = $request->validated();
            $escola = array(
                'nome'          => $dados['nome'],
                'segmento'      => $dados['segmento'],
                'endereco'      => isset($dados['endereco']) ? $dados['endereco'] : null,
                'pais'          => isset($dados['pais']) ? $dados['pais'] : null,
                'max_alunos'    => isset($dados['max_alunos']) ? $dados['max_alunos'] : null,
            );
            
            Escola::create($escola);
            return redirect()
                    ->route('escola.listar')
                    ->with('classe', 'success')
                    ->with('mensagem', 'Cadastro realizado com sucesso!');
        } catch (\Throwable $th) {
            report($th);
            return redirect()
                ->route('escola.listar')
                ->with('classe', 'danger')
                ->with('mensagem', 'Não foi possível realizar o cadastro!');
        }
    }
    public function editar($id){
        try {
            $escola = Escola::find($id);
            
            return view('escola.editar', compact('escola'));
        } catch (\Throwable $th) {
            report($th);
            return redirect()
                ->route('escola.listar')
                ->with('classe', 'danger')
                ->with('mensagem', 'Não foi possível localizar o cadastro!');
        }
    }
    public function atualizar(EscolaRequest $request, $id){
        try {
            $dados = $request->validated();
            $escola = Escola::find($id);
            $escola->nome          = $dados['nome'];
            $escola->segmento      = $dados['segmento'];
            $escola->endereco      = isset($dados['endereco']) ? $dados['endereco'] : null;
            $escola->pais          = isset($dados['pais']) ? $dados['pais'] : null;
            $escola->max_alunos    = isset($dados['max_alunos']) ? $dados['max_alunos'] : null;
            $escola->save();

            return redirect()
                ->route('escola.listar')
                ->with('classe', 'success')
                ->with('mensagem', 'Alteração realizada com sucesso!');
        } catch (\Throwable $th) {
            report($th);
            return redirect()
                ->route('escola.listar')
                ->with('classe', 'danger')
                ->with('mensagem', 'Não foi possível realizar a alteração!');
        }
    }
    public function excluir($id){
        try {
            /**
             * Verificar se possui escola antes de excluir
             */
            $escola = Escola::find($id);
            $escola->delete();

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
