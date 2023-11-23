@extends('layout.main') 

@section('title', 'Home')
    
@section('content')
    

    @include('componentes.titulo', ['titulo' => 'Suporte Tarefa'])
    
    <form action="{{ route('suporte-tarefa.salvar') }}" method="POST" enctype="multipart/form-data">
        
        @include('suporte-tarefa.form')
        
        <div class="mt-2 text-center">
            <a href="{{route('suporte-tarefa.listar')}}" class="btn btn-secondary">Voltar</a>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
    </form>

@endsection
{{-- <script src="{{mix('js/suporte-tarefa/suporte-tarefa.js')}}"></script> --}}
