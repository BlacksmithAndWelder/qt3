<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
        

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            
        </style>
        <link rel="stylesheet" href="{{mix('css/app.css')}}">
        <link rel="stylesheet" href="{{mix('css/layout/main.css')}}">
        <script src="{{mix('js/app.js')}}"></script>

    </head>
    <body id="antialiased">
        <div id="mySidenav" class="sidenav">
            <a href="{{route('home')}}">Home</a>
            <hr class="separador">
            <a href="{{route('escola.listar')}}"> - Escola</a>
            <a href="{{route('aluno.listar')}}"> - Aluno</a>
            <a href="{{route('turma.listar')}}"> - Turma</a>
            <hr class="separador">
            <a href="{{route('usuario.listar')}}"> - Usuário</a>
            <a href="{{route('suporte-tarefa-status.listar')}}"> - Suporte Tarefa Status</a>
            <a href="{{route('suporte-tarefa.listar')}}"> - Suporte Tarefa</a>
            <hr class="separador">
            <a href="{{route('nasa.detalhe')}}"> - API - Nasa</a>
        </div>
        <div id="content">
            <div id="content-header">
                <span style="font-size:30px;cursor:pointer" id="menu-btn">
                    <i class="fa-solid fa-bars"></i> 
                    Menu
                </span>
            </div>

            <div id="content-body">
                @yield('content')
            </div>
        </div>

        <footer></footer>
    </body>
</html>
<script src="{{mix('js/layout/main.js')}}"></script>
<script src="{{mix('js/layout/componentes/modal.js')}}"></script>
