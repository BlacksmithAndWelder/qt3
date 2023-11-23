@extends('layout.main') 

@section('title', 'Home')
    
@section('content')

    @include('componentes.titulo', ['titulo' => 'Escola'])
    
    <form action="{{ route('escola.salvar') }}" method="POST" enctype="multipart/form-data">
        
        @include('escola.form')
        
        <div class="mt-2 text-center">
            <a href="{{route('escola.listar')}}" class="btn btn-secondary">Voltar</a>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>

@endsection
{{-- <script src="{{mix('js/escola/criar.js')}}"></script> --}}
