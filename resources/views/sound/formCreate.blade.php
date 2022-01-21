@extends('layouts.app')


@section('content')
    <div class="container">
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
                            <label class="btn btn-white pe-auto position-absolute bottom-0 start-50 translate-middle" for="image"><i class="bi bi-camera-fill"></i> Upload Imagem</label>
                            <input class="d-none" type="file" name="image" id="image" accept=".png, .jpeg, .jpg">    
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome da musica/podcast</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                        </div>
                       
                        <div class="mb-3">
                            <label for="genre">Gênero</label>
                            <select class="form-select @error('genre') is-invalid @enderror" id="genre" name="genre">
                                <option value="" selected>Selecione um gênero</option>
                                @foreach ($genres as $genre)
                                    <option value={{$genre->id}}>{{$genre->name}}</option>
                                @endforeach
                            </select>
                            @error('genre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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

                        <button type="submit" class="btn btn-outline-dark btn-lg rounded-pill">Cancelar</button>
                        <button type="submit" class="btn btn-purple btn-lg rounded-pill float-end">Salvar</button>
                    </div>
                </form>
                
            </div>
          </div>
    </div>

@endsection