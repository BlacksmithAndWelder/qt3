@extends('layout.main') 

@section('title', 'Home')
    
@section('content')
    

    @include('componentes.titulo', ['titulo' => 'Suporte Tarefa Status'])
    
    <form action="{{ route('suporte-tarefa-status.salvar') }}" method="POST" enctype="multipart/form-data">
        
        @include('suporte-tarefa-status.form')
        
        <div class="mt-2 text-center">
            <a href="{{route('suporte-tarefa-status.listar')}}" class="btn btn-secondary">Voltar</a>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
    </form>

@endsection