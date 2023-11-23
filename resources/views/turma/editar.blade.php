@extends('layout.main') 

@section('title', 'Home')
    
@section('content')

    @include('componentes.titulo', ['titulo' => 'Atualização de Turma'])
    @include('componentes.mensagem')
    
    <form action="{{ route('turma.atualizar', $Turma->id) }}" method="POST" enctype="multipart/form-data">
        
        @include('turma.form')
        
        <div class="mt-2 text-center">
            <a href="{{route('turma.listar')}}" class="btn btn-secondary">Voltar</a>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>
@endsection

