@extends('layout.main') 

@section('title', 'Home')
    
@section('content')

    @include('componentes.titulo', ['titulo' => 'Atualização de Suporte Tarefa'])
    @include('componentes.mensagem')
    
    <form action="{{ route('suporte-tarefa.atualizar', $SuporteTarefa->id) }}" method="POST" enctype="multipart/form-data">
        
        @include('suporte-tarefa.form')
        
        <div class="mt-2 text-center">
            <a href="{{route('suporte-tarefa.listar')}}" class="btn btn-secondary">Voltar</a>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>

@endsection
{{-- <script src="{{mix('js/suporte-tarefa/suporte-tarefa.js')}}"></script> --}}
