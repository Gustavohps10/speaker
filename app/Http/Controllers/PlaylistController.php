<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Playlist;

class PlaylistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){

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

    public function addSound(){
    }

    public function removeSound(){
    }
}
