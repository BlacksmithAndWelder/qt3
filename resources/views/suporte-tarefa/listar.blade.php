@extends('layout.main') 

@section('title', 'Home')
    
@section('content')

@php
    $modelo     = 'suporte-tarefa';
    $cadastrar  = 'suporte-tarefa.criar';
    $editar     = 'suporte-tarefa.editar';
    $excluir    = 'suporte-tarefa.excluir';
    $titulo     = 'Suporte Tarefa';
@endphp

    @include('componentes.titulo')
    @include('componentes.mensagem')

    @include('componentes.botao-cadastrar')
    
    <div class="card">
        <div class="card-body">

            <table id="table" class="table datatable" width="100%">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th>Usuário</th>
                        <th>Assunto</th>
                        <th>Status</th>
                        <th>Urgente</th>
                        <th>Data última alteração</th>
                        <th class="text-center" scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ListaSuporteTarefa as $SuporteTarefa)
                        <tr>
                            <td scope="row">{{ $SuporteTarefa->id }}</td>
                            <td>{{$SuporteTarefa->usuario->name}}</td>
                            <td>{{$SuporteTarefa->assunto}}</td>
                            <td>{{$SuporteTarefa->status->nome}}</td>
                            <td>{{$SuporteTarefa->urgente ? 'Sim' : 'Não'}}</td>
                            <td>{{$SuporteTarefa->updated_at}}</td>
                            <td>
                                <div class="row justify-content-center">
                                    @include('componentes.acao-tabela', ['id' => $SuporteTarefa->id])
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
