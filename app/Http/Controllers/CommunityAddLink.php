<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommunityAddLink extends Controller
{
    //
        public function index()
    {
        // $links = CommunityLink::paginate(25);
        // $channels = Channel::orderBy('title','asc')->get();
        return view('dashboard', compact('links'));
    }
}
