@extends('layouts.app')

@section('content')
    
    <div class="container">

        <h2>Minhas Músicas</h2>
        <div style="display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(200px, 210px));
                    gap: 10px;
                    justify-content: center">
            @foreach ($mySounds as $sound)
                @php
                    $image = substr($sound->image, 0, 8) === "https://" 
                    ? $sound->image
                    : asset("storage/sounds/images/$sound->image");
                @endphp

                <div class="card p-0">
                    <img src={{$image}} class="card-img-top" alt="..." 
                    style="object-fit: cover;
                           height: 170px">
                    <div class="card-body">
                        <p class="card-title text-truncate ">{{$sound->name}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection