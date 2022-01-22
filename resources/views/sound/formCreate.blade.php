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
                    <div class="col-md-4 col-sm-12">
                        <div class="bg-purple position-relative" style="height: 300px; width:100%">
                            <img src="#" alt="" id="previewImage" 
                            style="object-fit: cover;
                                   max-width: 100%;
                                   height: 100%;">

                            <img class="position-absolute top-50 start-50 translate-middle" src={{asset('images/loading.svg')}} id="loading" style="display: none">
                            <input type="hidden" value="" id="autoImage" name="autoImage">
                            <label class="btn btn-white pe-auto position-absolute bottom-0 start-50 translate-middle" for="image"><i class="bi bi-camera-fill"></i> Upload Imagem</label>
                            <input class="d-none" type="file" name="image" id="image" accept=".png, .jpeg, .jpg">    
                        </div>
                    <div id="failedUploadImage" class="rounded border border-danger text-danger my-2 p-2" style="display: none">
                        <p class="mb-1">Falha ao carregar imagem automática, tente fazer o upload manualmente</p>
                    </div>
                    </div>
                    <div class="col-md-8 col-sm-12">
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

                        <button type="button" class="btn btn-outline-dark btn-lg rounded-pill">Cancelar</button>
                        <button type="submit" class="btn btn-purple btn-lg rounded-pill float-end">Salvar</button>
                    </div>
                </form>
                
            </div>
          </div>
    </div>

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jsmediatags/3.9.5/jsmediatags.min.js"></script>
<script>
    var  jsmediatags  =  window.jsmediatags;
    let audio = document.getElementById("audio");
    let img = document.getElementById("previewImage")
    audio.addEventListener("change", (e) => {
        let file = e.target.files[0];
        let search;
        jsmediatags.read(file, {
            onSuccess(result){
                $('#name').val(result.tags.title);
                if(result.tags.title){
                    search = result.tags.title;      
                }else{
                    search = file.name;
                }

                if(result.tags.artist){
                    search += " " + result.tags.artist
                }

                $.ajax({
                    method: 'get',
                    url: "{{ route('sound.getYoutubeVideoData') }}",
                    dataType: 'json',
                    data: {
                        search: search
                    },
                    beforeSend(){
                        $("#loading").show();
                    },
                    success(data){
                        if(!data.error){
                            url = data.items[0].snippet.thumbnails.medium.url;
                            img.src = url;
                            $('#autoImage').val(url);
                        }else{
                            $("#failedUploadImage").show()
                        }
                    },
                    complete(){
                        $("#loading").hide();
                    }
                });       
            },
            onError(error){
                console.log(error);
            }
        })
    });
</script>
@endsection