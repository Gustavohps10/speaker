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
        //Return view with form
        //Create a new playlist
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

    public function edit()
    {
        //Return view with form
        //Edit a new playlist
    }

    public function update()
    {
    }

    public function destroy()
    {
    }

    public function addSound(){
    }

    public function removeSound(){
    }
}
