@extends('layouts.app')

@php
    $image = substr($sound->image, 0, 8) === "https://" 
    ? $sound->image
    : asset("storage/sounds/images/$sound->image");
@endphp

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body md-3">
                <form class="row" action={{route('sound.update', ["sound" => $sound->id])}} method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    <div class="col-md-4 col-sm-12">
                        <div class="bg-purple position-relative" style="height: 300px; width:100%">
                            <img src={{$image}} alt="" id="previewImage" 
                            style="object-fit: cover;
                                   width: 100%;
                                   height: 100%;">
                                   
                            <img class="position-absolute top-50 start-50 translate-middle" src={{asset('images/loading.svg')}} id="loading" style="display: none">
                            <label class="btn btn-white pe-auto position-absolute bottom-0 start-50 translate-middle" for="image"><i class="bi bi-camera-fill"></i> Upload Imagem</label>
                            <input class="d-none" type="file" name="image" id="image" accept=".png, .jpeg, .jpg">    
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome da musica/podcast</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value='{{ $sound->name }}'>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                       
                        <div class="mb-3">
                            <label for="genre">Gênero</label>
                            <select class="form-select @error('genre') is-invalid @enderror" id="genre" name="genre">
                                <option value="">Selecione um gênero</option>
                                @foreach ($genres as $genre)
                                    <option value={{$genre->id}} @if($genre->id == $sound->genre->id) selected @endif>{{$genre->name}}</option>
                                @endforeach
                            </select>
                            @error('genre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating">
                            <textarea name="description" class="form-control" id="description" style="height: 100px">{{$sound->description}}</textarea>
                            <label for="description">Descrição</label>
                        </div>
                        <br>

                        <div class="form-floating">
                            <textarea name="lyrics" class="form-control"  id="lyrics" style="height: 100px">{{$sound->lyrics}}</textarea>
                            <label for="lyrics">Letra</label>
                        </div>
                        <br>

                        <a href={{ route('sound.index') }} class="btn btn-outline-dark btn-lg rounded-pill">Cancelar</a>
                        <button type="submit" class="btn btn-purple btn-lg rounded-pill float-end">Editar</button>
                    </div>
                </form>
                
            </div>
          </div>
    </div>

@endsection