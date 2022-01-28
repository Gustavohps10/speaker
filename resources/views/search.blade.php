@extends('layouts.app')

@section('content')
    <div class="container">
        <p class="fs-5">Resultado da busca por: <b class="text-purple">{{$str}}</b></p>
        <section>
            @if (count($sounds))
                <h1>Mídias</h1>
                <div style="display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(200px, 210px));
                    gap: 10px;
                    justify-content: center">
                    @foreach ($sounds as $sound)
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
                                <p class="m-0 soundName card-title text-truncate">{{$sound->name}}</p>
                                <div class="user d-flex align-items-center" style="color: #6c6c6c">
                                    <i class="bi bi-person-circle fs-5 me-1"></i>
                                    <p class="m-0 text-truncate"> {{$sound->user->name}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <h2 style="color: #adadad">Nenhuma mídia com esse nome foi encontrada</h2>
            @endif
        </section>

        <section id="usersSounds" class="my-5">
            @if (count($users))
                <h1>Mídias relacionadas a usuários</h1>
                <div style="display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(200px, 210px));
                    gap: 10px;
                    justify-content: center">
                    @foreach ($users as $user)
                        @foreach ($user->sounds as $sound)
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
                                    <p class="m-0 soundName card-title text-truncate">{{$sound->name}}</p>
                                    <div class="user d-flex align-items-center" style="color: #6c6c6c">
                                        <i class="bi bi-person-circle fs-5 me-1"></i>
                                        <p class="m-0 text-truncate"> {{$sound->user->name}}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            @endif
        </section>
        
    </div>
    
@endsection