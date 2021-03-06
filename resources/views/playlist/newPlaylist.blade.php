@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card sound-card col-md-6" style="right: 0; margin: 0 auto">
            <div class="card-header">
                Nova Playlist
            </div>
            <div class="car-body p-3">
                <form action="{{ route('playlist.add') }}" method="post">
                @csrf
                    <label for="name">Nome</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nome da playlist">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-check mt-1">
                        <input class="form-check-input" type="checkbox" name="public" value="public" id="playlistPublic" checked>
                        <label class="form-check-label" for="playlistPublic">
                        Pública
                        </label>
                    </div>
                    <button class="btn btn-purple mt-3">Criar</button>
                </form>
            </div>
        </div>
    </div>
@endsection