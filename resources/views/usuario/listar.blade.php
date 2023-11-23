@extends('layout.main') 

@section('title', 'Home')
    
@section('content')

@php
    $modelo     = 'usuario';
    $cadastrar  = 'usuario.criar';
    $editar     = 'usuario.editar';
    $excluir    = 'usuario.excluir';
    $titulo     = 'Usuário';
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
                        <th>Nome</th>
                        <th class="text-center" scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ListaUsuarios as $Usuario)
                        <tr>
                            <td scope="row">{{ $Usuario->id }}</td>
                            <td>{{$Usuario->name}}</td>
                            <td>
                                <div class="row justify-content-center">
                                    @include('componentes.acao-tabela', ['id' => $Usuario->id])
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
