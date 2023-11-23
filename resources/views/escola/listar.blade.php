@extends('layout.main') 

@section('title', 'Escola')
    
@section('content')

@php
    $modelo     = 'escola';
    $cadastrar  = 'escola.criar';
    $editar     = 'escola.editar';
    $excluir    = 'escola.excluir';
    $titulo     = 'Escola';
@endphp

    @include('componentes.titulo',['titulo' => $titulo])
    @include('componentes.mensagem')

    @include('componentes.botao-cadastrar')
    
    <div class="card">
        <div class="card-body">

            <table id="table" class="table" width="100%">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th>Nome</th>
                        <th class="text-center" scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ListaEscola as $Escola)
                        <tr>
                            <td scope="row">{{ $Escola->id }}</td>
                            <td>{{$Escola->nome}}</td>
                            <td>
                                <div class="row justify-content-center">
                                    
                                    @include('componentes.acao-tabela', ['id' => $Escola->id])
                                    
                                </div>                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        
        </div>
    </div>
@include('componentes.modal')

@endsection

{{-- <script src="{{mix('js/escola/listar.js')}}"></script> --}}
