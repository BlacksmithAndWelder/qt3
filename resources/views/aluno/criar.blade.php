@extends('layout.main')

@section('title', 'Home')
    
@section('content')
    

    @include('componentes.titulo', ['titulo' => 'Aluno'])
    
    <form action="{{ route('aluno.salvar') }}" method="POST" enctype="multipart/form-data">
        
        @include('aluno.form')
        
        <div class="mt-2 text-center">
            <a href="{{route('aluno.listar')}}" class="btn btn-secondary">Voltar</a>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
    </form>

@endsection
{{-- <script src="{{mix('js/aluno/aluno.js')}}"></script> --}}
