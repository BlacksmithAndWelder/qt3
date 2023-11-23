@extends('layout.main') 

@section('title', 'Home')
    
@section('content')

    @include('componentes.titulo', ['titulo' => 'Turma'])
    
    <form action="{{ route('turma.salvar') }}" method="POST" enctype="multipart/form-data">
        
        @include('turma.form')
        
        <div class="mt-2 text-center">
            <a href="{{route('turma.listar')}}" class="btn btn-secondary">Voltar</a>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
    </form>
@endsection
