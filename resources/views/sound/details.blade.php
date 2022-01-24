@extends('layouts.app')

@php
$image = substr($sound->image, 0, 8) === "https://" 
? $sound->image
: asset("storage/sounds/images/$sound->image");

$audio = asset("storage/sounds/audios/$sound->audio")
@endphp

@section('content')
    <section class="py-3" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url({{$image}}) no-repeat;
                    background-color: black;
                    background-size: cover;
                    margin-top: -3rem;
                    ">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12 position-relative" style="min-height: 200px">
                    <img class="position-absolute top-50 start-50 translate-middle" src="{{$image}}" style="height: 200px;width: 200px;object-fit: cover;">
                </div>
                <div class="col-md-8 col-sm-12 text-white mt-3">
                    <h1>{{$sound->name}}</h1>
                    <h4 style="color: #747474;">{{$sound->genre->name}}</h4>
                </div>
            </div>
        </div>
    </section >
         
    <section class="mt-3">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <h2>Letra</h2>
                    @if ($sound->lyrics)
                        <p style="color: #464646;">{!! nl2br($sound->lyrics) !!}</p>
                    @else
                    <p style="color: #464646;">Você ainda não definiu a letra</p>
                    @endif
                </div>
                <div class="col-sm-12 col-md-7">
                    <h2>Descrição</h2>
                    @if ($sound->description)
                        <p style="color: #464646;">{!!  nl2br($sound->description) !!}</p>
                    @else
                        <p style="color: #464646;">Você ainda não inseriu uma descrição</p>
                    @endif
                    
                </div>
            </div>
        </div>  
    </section>
@endsection

