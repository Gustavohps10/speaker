@extends('layouts.app')

@section('content')

<section>
    <div class="container">
        <h1>Novas</h1>
        <div class="news d-flex flex-nowrap gap-2 overflow-auto w-100 p-2" style="scroll-behavior: smooth;scroll-snap-type: x mandatory;">
            @foreach ($newSounds as $sound)
                @php
                $image = substr($sound->image, 0, 8) === "https://" 
                ? $sound->image
                : asset("storage/sounds/images/$sound->image");
                @endphp

                <div id={{$sound->id}} class="sound-card card p-0 shadow-lg" style="flex: none; width: 210px;scroll-snap-align: start;">
                    <a href={{route('sound.show', ['sound' => $sound->id])}}><img src={{$image}} class="card-img-top" alt="..." 
                    style="object-fit: cover;
                        height: 170px"></a>
                    <div class="card-body">
                        <p class="m-0 soundName card-title text-truncate">{{$sound->name}}</p>
                        <p class="m-0 d-inline-block" style="color: #747474">
                            <i class="bi bi-person-circle fs-5"></i> {{$sound->user->name}}
                        </p>
                        <div class="btn-group dropstart position-relative float-end">
                            <button type="button" class="rounded-circle btn btn-outline-gray position-relative" data-bs-toggle="dropdown" aria-expanded="false" style="width: 35px;height: 35px;">
                                <i class="bi bi-three-dots-vertical position-absolute" style="left: 9px;top: 5px;"></i>
                            </button>
                            <ul class="dropdown-menu" style="min-width: 140px;">
                                <li><button class="dropdown-item addToPlaylist" data-bs-toggle="modal" data-bs-target="#playlistsModal"><i class="bi bi-list-nested"></i> Salvar na playlist</button></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<div class="container">
    <div class="row mt-4">
        <div class="col-md-8 col-sm-12">
            <section>
                <h4 style="color: #747474">Popular</h4>
                <h1>Lorem ipsum</h1>
                <table class="w-100 home-table">
                    <thead>
                        <tr>
                            <th class="ps-3">#</th>
                            <th></th>
                            <th>Titulo</th>
                            <th>Autor</th>
                            <th>Album</th>
                            <th class="pe-3"> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i < 7; $i++)
                            <tr class="rounded text-truncate shadow" style="background-color: #222">
                                <td class="ps-3 rounded-start">0{{$i}}</td>
                                <td><img style="border-radius: 8px;" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRV38p5ki5dedtzp20RJtviIe9tJChgQiq4gQ&usqp=CAU" alt="" width="50" height="50"></td>
                                <td>Sound name</td>
                                <td>User name</td>
                                <td>Lorem Ipsum</td>
                                <td class="pe-3 rounded-end">{{$i}}:34</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </section>
        </div>
        <div class="col-md-4 col-sm-12">
            <section>
                <h4 style="color: #747474">Hot</h4>
                <h1>MV</h1>
                
                <div class="d-flex flex-wrap gap-3 justify-content-center">
                       <img class="shadow-lg"  src="https://i.scdn.co/image/ab67616d0000b273b0800f5459969cb9c086254b" alt="" style="height: 220px; width: 220px; object-fit: cover; border-radius: 25px" >
                       <img class="shadow-lg"  src="https://e.snmc.io/i/600/s/447e0c79c29d288db376d47689f4eb1a/7886690/meses-sobrio-amanha-e-noite-Cover-Art.jpg" alt="" style="height: 220px; width: 220px; object-fit: cover; border-radius: 25px" > 
                </div>
                
            </section>
        </div>
    </div>
</div>

<!--MODALS-->
<div class="modal fade" id="playlistsModal" tabindex="-1" aria-labelledby="playlistsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content sound-card">
        <div class="modal-header border-gray">
            <h5 class="modal-title" id="playlistsModalLabel">Escolha as playlists</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @foreach (Auth::user()->playlists as $playlist)
                <div class="form-check">
                    <input data-action={{ route('playlist.addsounds', ["playlist" => $playlist->id])}} class="form-check-input" type="checkbox" style="cursor: pointer">
                    <label class="form-check-label">{{$playlist->name}}</label>
                </div>
            @endforeach
        </div>
        <div class="modal-footer border-gray">
            <button type="button" class="btn btn-purple save">Salvar</button>
        </div>
        </div>
    </div>
</div>

<!--TOASTS-->
<div style="z-index: 9999" class="toast-container toast-container d-flex justify-content-center align-items-center flex-column position-fixed pt-3 w-100 top-0 start-0">
    <div class="toast align-items-center bg-danger toast-error" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body"></div>
          <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>

    <div class="toast align-items-center text-white bg-purple toast-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body"></div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/home.js') }}"></script>
@endsection