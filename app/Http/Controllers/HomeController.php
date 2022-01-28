<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sound;
use App\Models\User;

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
        return view('home');
    }

    public function search(Request $request){

        $str = $request->query('str');
        if(empty($str)){
            return redirect()->route('home');
        }

        $users = User::where('name', 'like', '%'.$str.'%')->get();
        $sounds = Sound::where('name', 'like', '%'.$str.'%')->get();

        return view('search', [
            "sounds" => $sounds,
            "users" => $users,
            "str" => $str
        ]);
    }
}
