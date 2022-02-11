<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sound;
use App\Models\User;
use App\Models\Playlist;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $newSounds = Sound::orderBy('id', "desc")->limit(20)->get();
        
        return view('home', [
            "newSounds" => $newSounds
        ]);
    }

    public function search(Request $request){

        $str = str_replace("%", "", $request->query('str')); 
        if(empty($str)){
            return redirect()->route('home');
        }

        $users = User::where('name', 'like', '%'.$str.'%')->get();
        $sounds = Sound::where('name', 'like', '%'.$str.'%')->get();
        $playlists = Playlist::where('name', 'like', '%'.$str.'%')
                                ->where('public', 1)
                                ->get();


        return view('search', [
            "sounds" => $sounds,
            "playlists" => $playlists,
            "users" => $users,
            "str" => $str
        ]);
    }
}
