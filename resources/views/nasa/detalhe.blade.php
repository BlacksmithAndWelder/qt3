@extends('layout.main') 

@section('title', 'Home')
    
@section('content')
@include('componentes.mensagem')


@isset($NasaDetalhe)
    <div id="" class="text-center pb-5 img-nasa">
        <div id="" class="">
            <img src="{{$NasaDetalhe->hdurl}}" class="rounded w-25" >
        </div>
        <div id="" class="rounded img-titulo">
            <h4>{{$NasaDetalhe->title}}</h2>
            <h5>{{$NasaDetalhe->date}}</p>
        </div>
    </div>
    <div id="div-explanation" class=" d-flex mt-3 justify-content-center">
        <div class="card w-25 p-3 col-md-6">
            <h2>Explanation</h2>
            <p>{{$NasaDetalhe->explanation}}</p>
        </div>
    </div>
    <div id="div-explanation" class="d-flex mt-3 mb-3 justify-content-center">
        <div class="card w-25 p-3 col-md-6">
            <h2>About the article</h2>
            <div class="">
                <span class="text-start">Date:</span>
                <span class="text-end">{{$NasaDetalhe->date}}</span>
                <i class="fa-solid fa-calendar-days"></i>
            </div>
            <hr>
            <div class="">
                <span>Media Type:</span>
                <span class="text-end">{{$NasaDetalhe->media_type}}</span>
                <i class="fa-solid fa-image"></i>
            </div>
            <hr>
            <div class="">
                <span>Font:</span>
                <span class="text-end">api.nasa.gov</span>
                <i class="fa-solid fa-earth-americas"></i>
            </div>
        </div>
    </div>
    <div id="div-explanation" class="d-flex mt-3 mb-3 justify-content-center">
        <img src="{{ asset("/images/nasa-logo.svg") }}">
    </div>
@endisset
@include('componentes.modal')
<script src="{{mix('js/nasa/detalhe.js')}}"></script>
<link rel="stylesheet" href="{{mix('css/nasa/detalhe.css')}}">

@endsection
