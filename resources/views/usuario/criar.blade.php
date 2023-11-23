@extends('layout.main') 

@section('title', 'Home')
    
@section('content')
    

    @include('componentes.titulo', ['titulo' => 'Usuário'])
    
    <form action="{{ route('usuario.salvar') }}" method="POST" enctype="multipart/form-data">
        
        @include('usuario.form')
        
        <div class="mt-2 text-center">
            <a href="{{route('usuario.listar')}}" class="btn btn-secondary">Voltar</a>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
    </form>

@endsection