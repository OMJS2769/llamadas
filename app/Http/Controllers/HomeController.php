<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRegistro;

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

    public function index()
    {
        return view('home');
    }

    public function uploadAudio(Request $request)
    {
        $r = UserRegistro::find($request->registro_id);
        $r->tiempo = $request->tiempo;
        $r->save();
        $blobInput = $request->file('audio_blob');
        return \Storage::put('audio/registro_' . $request->registro_id . '.wav', file_get_contents($blobInput));
    }
}
