@extends('layouts.app')

@section('content')
    
    <div class="container">

        <h2>Minhas Músicas</h2>
        <div style="display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(200px, 210px));
                    gap: 10px;
                    justify-content: center">
            @foreach ($mySounds as $sound)
                @php
                    $image = substr($sound->image, 0, 8) === "https://" 
                    ? $sound->image
                    : asset("storage/sounds/images/$sound->image");
                @endphp

                <div class="sound-card card p-0">
                    <a href={{route('sound.show', ['sound' => $sound->id])}}><img src={{$image}} class="card-img-top" alt="..." 
                    style="object-fit: cover;
                           height: 170px"></a>
                    <div class="card-body">
                        <p class="soundName card-title text-truncate">{{$sound->name}}</p>
                        
                               
                        <div class="btn-group dropstart position-relative float-end">
                            <button type="button" class="rounded-circle btn btn-outline-gray position-relative" data-bs-toggle="dropdown" aria-expanded="false" style="width: 35px;height: 35px;">
                                <i class="bi bi-three-dots-vertical position-absolute" style="left: 9px;top: 5px;"></i>
                            </button>
                            <ul class="dropdown-menu" style="min-width: 140px;">
                                <li><a class="dropdown-item" href={{ route('sound.edit', ['sound' => $sound->id]) }}><i class="bi bi-pencil-square"></i> Editar</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><button data-action={{ route('sound.destroy', ['sound' => $sound->id]) }} id={{$sound->id}} class="delete dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteSoundModal"><i class="bi bi-trash"></i> Deletar</button></li>
                            </ul>
                        </div>
                
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <!-- MODAL -->
    <div class="modal fade" id="deleteSoundModal" tabindex="-1" aria-labelledby="deleteSoundModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content sound-card">
            <div class="modal-header border-dark">
              <h5 class="modal-title" id="deleteSoundModalLabel">Confirmar exclusão</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
@endsection


@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $("li > .delete").on("click", function(){
        let soundId = $(this).attr('id');
        let soundName = $(this).parent("li").parent(".dropdown-menu").parent(".btn-group").siblings(".soundName").text();
        let action = $(this).data("action")
        $("#soundNameDeleted").html(soundName);
        $("#formDeleteSound").attr("action", action)
    })
</script>

@endsection

