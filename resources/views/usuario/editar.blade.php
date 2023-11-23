@extends('layout.main') 

@section('title', 'Home')
    
@section('content')

    @include('componentes.titulo', ['titulo' => 'Atualização de Usuário'])
    @include('componentes.mensagem')
    
    <form action="{{ route('usuario.atualizar', $Usuario->id) }}" method="POST" enctype="multipart/form-data">
        
        @include('usuario.form')
        
        <div class="mt-2 text-center">
            <a href="{{route('usuario.listar')}}" class="btn btn-secondary">Voltar</a>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>

@endsection