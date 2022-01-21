@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="toast align-items-center text-white bg-purple border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
            Hello, world! This is a toast message.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        </div>
        <div class="card">
            <div class="card-header">
              Featured
            </div>
            <div class="card-body md-3">
                <form class="row" action={{route('sound.store')}} method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="mb-3">
                        <label for="audio" class="form-label">Audio</label>
                        <input class="form-control" type="file" id="audio" name="audio" accept=".mp3">
                    </div>
                    <div class="col-4">
                        <div class="bg-purple position-relative" style="height: 300px; width:100%">
                            <label class="btn btn-white pe-auto position-absolute bottom-0 start-50 translate-middle-x" for="image"><i class="bi bi-camera-fill"></i>Upload Imagem</label>
                            <input class="d-none" type="file" name="image" id="image" accept=".png, .jpeg, .jpg">    
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="mb-3">
                            <label for="name" class="form-label">Titulo</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                       
                        <div class="mb-3">
                            <label for="genre">Gênero</label>
                            <select class="form-select" aria-label="Default select example" id="genre" name="genre">
                                <option selected>Selecione um gênero</option>
                                @foreach ($genres as $genre)
                                    <option value={{$genre->id}}>{{$genre->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-floating">
                            <textarea name="description" class="form-control" id="description" style="height: 100px"></textarea>
                            <label for="description">Descrição</label>
                        </div>
                        <br>

                        <div class="form-floating">
                            <textarea name="lyrics" class="form-control"  id="lyrics" style="height: 100px"></textarea>
                            <label for="lyrics">Letra</label>
                        </div>
                        <br>

                        <button type="submit" class="btn btn-purple btn-lg rounded-pill float-end">Salvar</button>
                    </div>
                </form>
                
            </div>
          </div>
    </div>

@endsection