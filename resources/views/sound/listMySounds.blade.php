@extends('layouts.app')

@section('content')
    
    <div class="container">

        <h2>Minhas Músicas</h2>
        <section class="d-grid gap-2 justify-content-center" style="grid-template-columns: repeat(auto-fit, minmax(200px, 210px));">
            @foreach ($mySounds as $sound)
                @php
                    $image = substr($sound->image, 0, 8) === "https://" 
                    ? $sound->image
                    : asset("storage/sounds/images/$sound->image");
                @endphp

                <div id={{$sound->id}} class="sound-card card p-0">
                    <a href={{route('sound.show', ['sound' => $sound->id])}}>
                        <img src={{$image}} class="card-img-top" alt="..." 
                                style="object-fit: cover;
                                height: 170px">
                    </a>
                    <div class="card-body">
                        <p class="soundName card-title text-truncate">{{$sound->name}}</p>      
                        <div class="btn-group dropstart position-relative float-end">
                            <button type="button" class="rounded-circle btn btn-outline-gray position-relative" data-bs-toggle="dropdown" aria-expanded="false" style="width: 35px;height: 35px;">
                                <i class="bi bi-three-dots-vertical position-absolute" style="left: 9px;top: 5px;"></i>
                            </button>
                            <ul class="dropdown-menu" style="min-width: 140px;">
                                <li><button class="dropdown-item addToPlaylist" data-bs-toggle="modal" data-bs-target="#playlistsModal"><i class="bi bi-list-nested"></i> Salvar na playlist</button></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href={{ route('sound.edit', ['sound' => $sound->id]) }}><i class="bi bi-pencil-square"></i> Editar</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><button data-action={{ route('sound.destroy', ['sound' => $sound->id]) }} id={{$sound->id}} class="delete dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteSoundModal"><i class="bi bi-trash"></i> Deletar</button></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </section>

        <h2>Minhas Playlists</h2>
        <section class="d-grid gap-2 justify-content-center" style="grid-template-columns: repeat(auto-fit, minmax(200px, 210px));">
            @foreach ($myPlaylists as $playlist)
                <div class="card sound-card">
                    <div class="img-container text-center position-relative">
                        <img src={{ asset('images/music-note.svg') }} class="card-img-top" alt="..." 
                        style="object-fit: cover;
                            height: 170px">
                        <a href="#" class="play btn btn-purple position-absolute end-0 bottom-0 m-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px;height: 50px;">
                            <i class="bi bi-play-fill fs-4" style="margin-left: 3px;margin-top: 3px;"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <p class="soundName card-title text-truncate">{{$playlist->name}}</p>
                        <div class="btn-group dropstart position-relative float-end">
                            <button type="button" class="rounded-circle btn btn-outline-gray position-relative" data-bs-toggle="dropdown" aria-expanded="false" style="width: 35px;height: 35px;">
                                <i class="bi bi-three-dots-vertical position-absolute" style="left: 9px;top: 5px;"></i>
                            </button>
                            <ul class="dropdown-menu" style="min-width: 140px;">
                                <li><a class="dropdown-item" href={{ route('playlist.edit', ['playlist' => $playlist->id]) }}><i class="bi bi-pencil-square"></i> Editar</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><button data-action={{ route('playlist.destroy', ['playlist' => $playlist->id]) }} id={{$playlist->id}} class="delete dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteSoundModal"><i class="bi bi-trash"></i> Deletar</button></li>
                            </ul>
                        </div>
                    </div>
                </div>
             @endforeach
        </section>
    </div>


    <!-- MODALS -->
    <div class="modal fade" id="deleteSoundModal" tabindex="-1" aria-labelledby="deleteSoundModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content sound-card">
            <div class="modal-header border-dark">
              <h5 class="modal-title" id="deleteSoundModalLabel">Confirmar exclusão</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja excluir <b id="soundNameDeleted"></b> permanentemente?</p>
            </div>
            <div class="modal-footer border-dark">
                <form id="formDeleteSound" action="#" method="post">
                @csrf
                @method("DELETE")
                
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </div>
          </div>
        </div>
    </div>


    <div class="modal fade" id="playlistsModal" tabindex="-1" aria-labelledby="playlistsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content sound-card">
            <div class="modal-header border-gray">
                <h5 class="modal-title" id="playlistsModalLabel">Escolha as playlists</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @foreach ($myPlaylists as $playlist)
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
    <script src="{{ asset('js/mySounds.js') }}"></script>

@endsection

