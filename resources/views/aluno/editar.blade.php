@extends('layout.main')

@section('title', 'Home')
    
@section('content')

    @include('componentes.titulo', ['titulo' => 'Atualização de Aluno'])
    @include('componentes.mensagem')
    
    <form action="{{ route('aluno.atualizar', $Aluno->id) }}" method="POST" enctype="multipart/form-data">
        
        @include('aluno.form')
        
        <div class="mt-2 text-center">
            <a href="{{route('aluno.listar')}}" class="btn btn-secondary">Voltar</a>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>

@endsection
