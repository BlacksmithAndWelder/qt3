@extends('layout.main') 

@section('title', 'Home')
    
@section('content')

@php
    $modelo     = 'turma';
    $cadastrar  = 'turma.criar';
    $editar     = 'turma.editar';
    $excluir    = 'turma.excluir';
    $titulo     = 'Turma';
@endphp

    @include('componentes.titulo')
    @include('componentes.mensagem')

    @include('componentes.botao-cadastrar')
    
    <div class="card">
        <div class="card-body">

            <table id="table" class="table" width="100%">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th>Escola</th>
                        <th>Equipe</th>
                        <th>Sala</th>
                        <th class="text-center" scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ListaTurma as $Turma)
                        <tr>
                            <td scope="row">{{ $Turma->id }}</td>
                            <td>{{$Turma->escola->nome}}</td>
                            <td>{{$Turma->equipe}}</td>
                            <td>{{$Turma->sala}}</td>
                            <td>
                                <div class="row justify-content-center">
                                    @include('componentes.acao-tabela', ['id' => $Turma->id])
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
