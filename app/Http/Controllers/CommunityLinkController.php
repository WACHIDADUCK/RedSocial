<?php

namespace App\Http\Controllers;

use App\Models\CommunityLink;
use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = CommunityLink::paginate(25);
        $channels = Channel::orderBy('title','asc')->get();
        return view('dashboard', compact('links','channels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(Request $request)
        {
            $data = $request->validate([
                'title' => 'required|max:255',
                'link' => 'required|unique:community_links|url|max:255',
                'channel_id' => 'required|exists:channels,id'
                ]);
                
                $link = new CommunityLink($data);
                // Si uso CommunityLink::create($data) tengo que declarar user_id y channel_id como $fillable
                $link->user_id = Auth::id();
                $link->save();
                
            $request->merge([
                'user_id' => Auth::id(),
                ]);
            
            // CommunityLink::create($request->all());
            return back();
        }

    /**
     * Display the specified resource.
     */
    public function show(CommunityLink $communityLink)
    {
        // Returna una "vista" llamada "borrar.blade.php" creada en la carpeta "View"
        return view("borrar");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommunityLink $communityLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CommunityLink $communityLink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommunityLink $communityLink)
    {
        //
    }
}
