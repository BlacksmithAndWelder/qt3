@extends('layout.main') 

@section('title', 'Home')
    
@section('content')

    @include('componentes.titulo', ['titulo' => 'Atualização de Suporte Tarefa Status'])
    @include('componentes.mensagem')
    
    <form action="{{ route('suporte-tarefa-status.atualizar', $SuporteTarefaStatus->id) }}" method="POST" enctype="multipart/form-data">
        
        @include('suporte-tarefa-status.form')
        
        <div class="mt-2 text-center">
            <a href="{{route('suporte-tarefa-status.listar')}}" class="btn btn-secondary">Voltar</a>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>

@endsection