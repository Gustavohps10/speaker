@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card sound-card col-md-6" style="right: 0; margin: 0 auto">
            <div class="card-header">
                Editar Playlist {{$playlist->id}}
            </div>
            <div class="car-body p-3">
                <form action={{ route('playlist.update', ["playlist" => $playlist->id]) }} method="post">
                @csrf
                @method("PUT")
                    <label for="name">Nome</label>
                    <input value='{{$playlist->name}}' type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nome da playlist">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-check mt-1">
                        <input class="form-check-input" type="checkbox" name="public" value="public" id="playlistPublic" @if ($playlist->public) checked @endif>
                        <label class="form-check-label" for="playlistPublic">
                        Pública
                        </label>
                    </div>
                    <button class="btn btn-purple mt-3">Editar</button>
                </form>
            </div>
        </div>
    

        @if(count($playlist->sounds))
            <h2 class="mt-5">Faixas desta playlist</h2>
            <section class="d-grid gap-2 justify-content-center" style="grid-template-columns: repeat(auto-fit, minmax(200px, 210px));">
                @foreach ($playlist->sounds as $sound)
                    @php
                        $image = substr($sound->image, 0, 8) === "https://" 
                        ? $sound->image
                        : asset("storage/sounds/images/$sound->image");
                    @endphp

                    <div id={{$sound->id}} class="sound-card card p-0">
                        <a href={{route('playlist.show', ['playlist' => $playlist->id, 'sound' => $sound->id])}}>
                            <img src={{$image}} class="card-img-top" alt="..." 
                                    style="object-fit: cover;
                                    height: 170px">
                        </a>
                        <div class="card-body">
                            <p class="soundName card-title text-truncate">{{$sound->name}}</p>      
                            <p class="m-0 d-inline-block" style="color: #747474">
                                <i class="bi bi-person-circle fs-5"></i> {{$sound->user->name}}
                            </p>
                            <div class="btn-group dropstart position-relative float-end">
                                <button type="button" class="rounded-circle btn btn-outline-gray position-relative" data-bs-toggle="dropdown" aria-expanded="false" style="width: 35px;height: 35px;">
                                    <i class="bi bi-three-dots-vertical position-absolute" style="left: 9px;top: 5px;"></i>
                                </button>
                                <ul class="dropdown-menu" style="min-width: 140px;">
                                    <li><button id={{$sound->id}} class="delete dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteSoundModal"><i class="bi bi-trash"></i> Remover da playlist</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </section>
        @endif
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
                <p>Tem certeza que deseja remover <b id="soundNameDeleted"></b> desta playlist?</p>
            </div>
            <div class="modal-footer border-dark">
                <button type="submit" class="btn btn-danger confirmDeletion">Remover</button>
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
    <script>
        var playlistUrl = "{{ route('playlist.removesounds', ["playlist" => $playlist->id])}}";
    </script>
    <script src="{{ asset('js/editPlaylist.js') }}"></script>
@endsection