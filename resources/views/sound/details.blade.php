@extends('layouts.app')

@php
$image = substr($sound->image, 0, 8) === "https://" 
? $sound->image
: asset("storage/sounds/images/$sound->image");

$audio = asset("storage/sounds/audios/$sound->audio")
@endphp

@section('content')
    <section class="py-3" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url({{$image}}) no-repeat;
                    background-color: black;
                    background-size: cover;
                    margin-top: -3rem;
                    ">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12 position-relative" style="min-height: 200px">
                    <img class="position-absolute top-50 start-50 translate-middle" src="{{$image}}" style="height: 200px;width: 200px;object-fit: cover;">
                </div>
                <div class="col-md-8 col-sm-12 text-white mt-3">
                    <h1>{{$sound->name}}</h1>
                    <h4 style="color: #747474;">{{$sound->genre->name}}</h4>
                    <audio controls id="sound">
                        <source src="{{$audio}}" type="audio/mpeg">
                       </audio>
                    <div id="waveform"></div>
                    <span id="currentTime" class="text-white mt-1">00:00</span>
                    <span id="duration" class="text-white mt-1"></span>

                    <div id="controls" class="mt-3 bg-dark p-2 rounded d-flex flex-wrap">
                        <button class="btn btn-purple" id="play">
                            <i class="bi bi-play-fill"></i> / <i class="bi bi-pause-fill"></i>
                        </button>

                        <div id="range" class="d-inline-block mx-3">
                            <label class="form-check-label" for="repeatSound">Repetir</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="repeatSound" style="cursor: pointer">
                            </div>
                        </div>
                        
                        <div id="volumeContainer" class="d-flex align-items-center ms-auto">
                            <input value='100' max='100' type="range" class="form-range mx-1" id="volume" style="width: 100px">
                            <button id="btnMute" class="btn btn-purple"><i class="bi bi-volume-up-fill"></i></button>
                            <button id="btnUnmute" class="btn btn-danger"><i class="bi bi-volume-mute-fill"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section >
         
    <section class="mt-3">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <h2>Letra</h2>
                    @if ($sound->lyrics)
                        <p style="color: #464646;">{!! nl2br($sound->lyrics) !!}</p>
                    @else
                    <p style="color: #464646;">A letra não foi definida</p>
                    @endif
                </div>
                <div class="col-sm-12 col-md-7">
                    <h2>Descrição</h2>
                    @if ($sound->description)
                        <p style="color: #464646;">{!!  nl2br($sound->description) !!}</p>
                    @else
                        <p style="color: #464646;">Nenhuma descrição inserida</p>
                    @endif
                    
                </div>
            </div>
        </div>  
    </section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/2.0.4/wavesurfer.min.js"></script>
<script>
    var wavesurfer = WaveSurfer.create({
        container: document.querySelector('#waveform'),
        backend: 'MediaElement',
        waveColor: '#fff',
        progressColor: '#6f42c1',
        barWidth: 4,
        responsive: true,
        hideScrollbar: true
    });
    wavesurfer.setProgressColor('#6f42c1');
    var mediaElt = document.querySelector('#sound');
    wavesurfer.cancelAjax();

    wavesurfer.on('ready', function () {
        let duration = wavesurfer.getDuration();
        document.querySelector('#duration').innerText = "/ "+ secondsToHms(duration);
    });

    let wavePeaks = Object.values({!! $wavePeaks !!});
    wavesurfer.load(mediaElt, wavePeaks);

    let currentTime = document.querySelector("#currentTime");
    wavesurfer.on('audioprocess', function () {
        let currentTimeInSeconds = Math.trunc(wavesurfer.getCurrentTime());
        convertedTime = secondsToHms(currentTimeInSeconds);
        currentTime.innerText = convertedTime;
    });

    /*
    *CONTROLS
    */

    //Play and pause
    document.querySelector('#play').addEventListener('click', ()=>{
        wavesurfer.playPause();
    })

    //Volume
    let volume = document.querySelector('#volume');
    volume.addEventListener('input', ()=>{
        let volumeValue = parseInt(volume.value) / 100;
        if(volumeValue >=0 && volumeValue <= 1 && !wavesurfer.getMute()){
            wavesurfer.setVolume(volumeValue);
        }
    });

    //Mute-Unmute
    let btnMute = document.querySelector('#btnMute');
    btnMute.addEventListener('click', ()=>{
        wavesurfer.setMute(true);
        btnUnmute.style.display = 'block';
        btnMute.style.display = 'none';
        volume.setAttribute("disabled", "disabled")
    })

    let btnUnmute = document.querySelector('#btnUnmute');
    btnUnmute.style.display = 'none';
    btnUnmute.addEventListener('click', ()=>{
        wavesurfer.setMute(false);
        btnUnmute.style.display = 'none';
        btnMute.style.display = 'block';
        volume.removeAttribute("disabled")
    })

    //Repeat
    let repeat = document.querySelector('#repeatSound');
    wavesurfer.on('finish', function () {
        if(repeat.checked) {
            wavesurfer.play(0);
        }
    });

    function secondsToHms(d) {
        d = Number(d);
        var h = Math.floor(d / 3600);
        var m = Math.floor(d % 3600 / 60);
        var s = Math.floor(d % 3600 % 60);

        var hDisplay = (h < 10 ? "0" : "") + h;
        var mDisplay = (m < 10 ? "0" : "") + m;
        var sDisplay = (s < 10 ? "0" : "") + s;

        if(h < 1){
            return mDisplay + ":" + sDisplay
        }
        return hDisplay + ":" + mDisplay + ":" + sDisplay; 
    }
    
</script>
    
@endsection