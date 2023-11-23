@extends('layout.main') 

@section('title', 'Escola')
    
@section('content')

    @include('componentes.titulo', ['titulo' => 'Atualização de Escola'])
    @include('componentes.mensagem')
    
    <form action="{{ route('escola.atualizar', $Escola->id) }}" method="POST" enctype="multipart/form-data">
        
        @include('escola.form')
        
        <div class="mt-2 text-center">
            <a href="{{route('escola.listar')}}" class="btn btn-secondary">Voltar</a>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>

@endsection
{{-- <script src="{{mix('js/escola/editar.js')}}"></script> --}}
