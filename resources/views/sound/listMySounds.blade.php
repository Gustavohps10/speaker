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
                    <a href={{route('sound.show', ['sound' => $sound->id])}}><img src={{$image}} class="card-img-top" alt="..." 
                    style="object-fit: cover;
                           height: 170px"></a>
                    <div class="card-body">
                        <p class="card-title text-truncate ">{{$sound->name}}</p>
                        
                        <div class="position-relative float-end">          
                            <div class="btn-group dropstart">
                                <button type="button" class="rounded-circle btn btn-outline-dark position-relative" data-bs-toggle="dropdown" aria-expanded="false" style="width: 35px;height: 35px;">
                                    <i class="bi bi-three-dots-vertical position-absolute" style="left: 9px;top: 5px;"></i>
                                </button>
                                <ul class="dropdown-menu" style="min-width: 140px;">
                                    <li><a class="dropdown-item" href={{ route('sound.edit', ['sound' => $sound->id]) }}><i class="bi bi-pencil-square"></i> Editar</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-trash"></i> Deletar</a></li>
                                </ul>
                            </div>
                           
                        </div>
                        
                        <!--<a class="float-end text-dark" href={{ route('sound.edit', ["sound" => $sound->id])}}>Editar</a>
                        -->
                        </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection