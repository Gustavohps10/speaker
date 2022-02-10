<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Playlist;
use App\Models\Sound;

class PlaylistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Playlist $playlist, Sound $sound)
    {
        if(!$playlist->sounds()->where('sound_id', $sound->id)->exists()){
            return redirect()->route("sound.index");
        }

        if(!$playlist->public && Auth::id() != $playlist->user->id){
            return redirect()->route("sound.index");
        }
        
        $wavePeaks = $sound->wave_peaks;
        return view('playlist.showPlaylist', [
            "playlist" => $playlist,
            "sound" => $sound,
            "wavePeaks" => $wavePeaks
        ]);
    }

    public function create()
    {
        return view('playlist.newPlaylist');
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $public = !empty($request->public) ? 1 : 0;

        $playlist = new Playlist();
        $playlist->name = $request->name;
        $playlist->public = $public;
        $playlist->user()->associate(Auth::user());
        $playlist->save();
      
        return redirect()->route('sound.index');
    }

    public function edit(Playlist $playlist)
    {
        if($playlist->user->id != Auth::id()){
            return redirect()->route('sound.index');
        }

        return view('playlist.editPlaylist',[
            "playlist" => $playlist
        ]);
    }

    public function update(Request $request, Playlist $playlist)
    {
        if($playlist->user->id != Auth::id()){
            return redirect()->route('sound.index');
        }

        $request->validate([
            'name' => 'required|max:255',
        ]);

        $public = !empty($request->public) ? 1 : 0;
        $playlist->name = $request->name;
        $playlist->public = $public;
        $playlist->save();
        return redirect()->route('sound.index');
    }

    public function destroy(Playlist $playlist)
    {
        if($playlist->user->id != Auth::id()){
            return redirect()->route('sound.index');
        }
        
        $playlist->delete();
        return redirect()->route('sound.index');
    }

    public function addSounds(Request $request, Playlist $playlist){
        if($playlist->user->id != Auth::id()){
            return;
        }

        $data = [];
        $data["error"]["repeateds"] = [];
        
        if(empty($request->soundList) || !is_array($request->soundList) || !count($request->soundList)){
            $data["error"]["msg"] = "Nenhuma musica foi selecionada";
            return json_encode($data);
        }

        $soundIdList = array_unique($request->soundList);

        foreach($soundIdList as $soundId){
            if(!$sound = Sound::find($soundId)){
                $data["error"]["msg"] = "Algo deu errado, tente novamente";
            }elseif($playlist->sounds()->where('sound_id', $sound->id)->exists()){
                $data["error"]["msg"] = "Você está tentando adicionar musicas repetidas na playlist";
                array_push($data["error"]["repeateds"], json_decode($sound));
            }else{
                $playlist->sounds()->attach($sound->id);
            }
        }

        if(!empty($data["error"]["repeateds"]) || !empty($data["error"]["msg"])){
            return json_encode($data);
        }
        
        unset($data["error"]);
        $data["success"] = "Adicionado com sucesso";
        return json_encode($data);
    }

    public function removeSounds(Request $request, Playlist $playlist){
        if($playlist->user->id != Auth::id()){
            return;
        }

        $data = [];

        if(empty($request->soundList) || !is_array($request->soundList) || !count($request->soundList)){
            $data["error"]["msg"] = "Nenhuma música foi selecionada";
            return json_encode($data);
        }

        $soundIdList = array_unique($request->soundList);

        foreach($soundIdList as $soundId){
            if(!$sound = Sound::find($soundId)){
                $data["error"]["msg"] = "Algo deu errado, tente novamente";
            }elseif(!$playlist->sounds()->where('sound_id', $sound->id)->exists()){
                $data["error"]["msg"] = "Esta música não está associada á esta playlist";
            }else{
                $playlist->sounds()->detach($sound->id);
            }
        }

        if(!empty($data["error"]["msg"])){
            return json_encode($data);
        }
        
        unset($data["error"]);
        $data["success"] = "Removido com sucesso";
        return json_encode($data);
    }
}
