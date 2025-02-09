<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Sound;
use App\Models\Genre;

use BoyHagemann\Wave\Wave;
use maximal\audio\Waveform;

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
        $mySounds = Auth::user()->sounds;
        $myPlaylists = Auth::user()->playlists;

        return view('sound.listMySounds', [
            "mySounds" => $mySounds,
            "myPlaylists" => $myPlaylists
        ]);
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
        
        //Waveform
        $file = Storage::disk('public')->path("sounds/audios/$sound->audio");
        $waveformData = $this->generateWaveformData($file);
        $jsonWaveformData = json_encode($waveformData['lines1']);
        
        $sound->wave_peaks = $jsonWaveformData;
        $sound->save();
        return redirect()->route('sound.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sound $sound)
    {   
        $wavePeaks = $sound->wave_peaks;
       
        return view('sound.details', [
            "sound" => $sound,
            "wavePeaks" => $wavePeaks
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sound $sound)
    {
        if($sound->user->id != Auth::id()){
            return redirect()->route("sound.index");
        }

        $genres = Genre::all();
        return view('sound.formEdit', [
            "sound" => $sound,
            "genres" => $genres
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sound $sound)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'genre' => 'required|exists:App\Models\Genre,id',
            'image' => 'file|filled|image',
        ]);

        if($sound->user->id != Auth::id()){
            return redirect()->route("sound.index");
        }

        if($request->file('image')){
            $image = $request->file('image');
            Storage::disk('public')->delete("sounds/images/$sound->image");
            $image->store('sounds/images');
            $sound->image = $image->hashName();
        }

        $sound->name = $request->name;
        $sound->lyrics = $request->lyrics;
        $sound->description = $request->description;
        //Relationships
        $sound->genre()->associate(Genre::find($request->genre));
        $sound->save();
        return redirect()->route("sound.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sound $sound)
    {
        if($sound->user->id != Auth::id()){
            return redirect()->route("sound.index");
        }

        $sound->delete();
        Storage::disk('public')->delete("sounds/images/$sound->image");
        Storage::disk('public')->delete("sounds/audios/$sound->audio");

        return redirect()->route("sound.index");
    }

    public function getYoutubeVideoData()
    {
        $search = !empty($_GET["search"]) ? $_GET["search"] : "";
        $response = Http::get("https://www.googleapis.com/youtube/v3/search", [
            "key"=> "ramdom_123456",
            "maxResults" => "1",
            "part" => "snippet",
            "type" => "video",
            "q" => $search
        ]);
        echo $response;
    }

    private function generateWaveformData(string $file){
        $waveform = new Waveform($file);
        $width = 100;
        $data = $waveform->getWaveformData($width, true);
        return $data;
    }
}
