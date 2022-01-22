<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Sound;
use App\Models\Genre;

class SoundController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "LIST SOUNDS HERE";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $genres = Genre::all();
        return view('sound.formCreate', [
            "genres" => $genres
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'genre' => 'required|exists:App\Models\Genre,id',
            'image' => 'file|filled|image',
            'audio' => 'required|file|filled|mimes:mp3',
            'autoImage' => 'required|active_url|ends_with:.jpg,.jpeg,.png'
        ]);
        
        $genre = Genre::find($request->genre);
        $user = Auth::user();
        $audio = $request->file('audio');
        $audio->store('sounds/audios');
        $image = $request->file('image');

        if($request->file('image')){
            $image = $request->file('image');
            $image->store('sounds/images');
            $imageName = $image->hashName();
        }else{
            $imageName = $request->autoImage;
        }

        $sound = new Sound();
        $sound->name = $request->name;
        $sound->description = $request->description;
        $sound->lyrics = $request->lyrics;
        $sound->audio = $audio->hashName();
        $sound->image = $imageName;
        //Relationships
        $sound->genre()->associate($genre);
        $sound->user()->associate($user);
        $sound->save();
        
        return redirect()->route('sound.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getYoutubeVideoData()
    {
        $search = !empty($_GET["search"]) ? $_GET["search"] : "";
        $response = Http::get("https://www.googleapis.com/youtube/v3/search", [
            "key"=> "AIzaSyDhx-PJf_KEA5eT2_lbi1uiXXzw_YiTyMs",
            "maxResults" => "1",
            "part" => "snippet",
            "type" => "video",
            "q" => $search
        ]);
        echo $response;
    }
}
