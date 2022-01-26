@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
              Featured
            </div>
            <div class="card-body md-3">
                <form id="formRegister" class="row" action={{route('sound.store')}} method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="mb-3">
                        <label for="audio" class="form-label">Audio</label>
                        <input class="form-control" type="file" id="audio" name="audio" accept=".mp3">
                        
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="bg-purple position-relative" style="height: 300px; width:100%">
                            <img src="https://1.bp.blogspot.com/-EDZps-bBH5c/UMNE3WpbOdI/AAAAAAAANHM/_MwF91CRQ8I/s1600/Wallpaper+-+Sound+Baixe+Renders.jpg" alt="" id="previewImage" 
                            style="object-fit: cover;
                                   width: 100%;
                                   height: 100%;">

                            <img class="position-absolute top-50 start-50 translate-middle" src={{asset('images/loading.svg')}} id="loading" style="display: none">
                            <input type="hidden" value="https://1.bp.blogspot.com/-EDZps-bBH5c/UMNE3WpbOdI/AAAAAAAANHM/_MwF91CRQ8I/s1600/Wallpaper+-+Sound+Baixe+Renders.jpg" id="autoImage" name="autoImage">
                            <label class="shadow btn btn-white pe-auto position-absolute bottom-0 start-50 translate-middle" for="image"><i class="bi bi-camera-fill"></i> Upload Imagem</label>
                            <input class="d-none" type="file" name="image" id="image" accept=".png, .jpeg, .jpg">    
                        </div>

                        <div class="form-check my-1">
                            <input class="form-check-input" type="checkbox" id="generateAutoImage" checked>
                            <label class="form-check-label" for="generateAutoImage">Gerar Imagem Automaticamente</label>
                            <p class="text-purple">Isso irá gerar uma imagem quando o audio for mudado</p>
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
                        <button id="btnRegister" type="submit" class="btn btn-purple btn-lg rounded-pill float-end position-relative" style="min-width: 132px; min-height: 53px;">
                            <img class="position-absolute top-50 start-50 translate-middle" src={{asset('images/circle-loading.svg')}} id="loadingButton" style="height: 30px; display: none">
                            <span>Salvar</span>
                        </button>
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
    let img = document.getElementById("previewImage");
    let generateAutoImage = document.getElementById("generateAutoImage");
    audio.addEventListener("change", (e) => {
        let file = e.target.files[0];
        let search;
        jsmediatags.read(file, {
            onSuccess(result){
                $('#name').val(result.tags.title);

                if(generateAutoImage.checked){
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
                }else{
                    $("#failedUploadImage").hide();
                }
                      
            },
            onError(error){
                console.log(error);
            }
        })
    });

    let inputImage = document.getElementById('image');
    inputImage.addEventListener('change', (e) => {
        let file = e.target.files[0];
        let reader =  new FileReader();
        reader.onloadend = () => {
            img.src = reader.result;
            $("#failedUploadImage").hide();
        }

        reader.readAsDataURL(file)
    });


    $("#formRegister").on('submit', function(){
        $("#btnRegister > span").hide();
        $("#btnRegister > img").show();
    });
</script>
@endsection