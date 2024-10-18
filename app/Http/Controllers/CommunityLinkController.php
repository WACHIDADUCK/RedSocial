<?php

namespace App\Http\Controllers;

use App\Models\CommunityLink;
use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommunityLinkForm;

class CommunityLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = CommunityLink::where('approved', 1)->paginate(25);
        $channels = Channel::orderBy('title','asc')->get();
        return view('dashboard', compact('links','channels'));
    }

    public function myLinks()
    {
        $links = CommunityLink::where('user_id', Auth::id())->paginate(10);
        $channels = Channel::orderBy('title','asc')->get();
        return view("mylinks", compact('links','channels'));
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
        public function store(CommunityLinkForm  $request)
        {   
                $data = $request->validated();
                $link = new CommunityLink($data);
                // Si uso CommunityLink::create($data) tengo que declarar user_id y channel_id como $fillable
                $link->user_id = Auth::id();
                $link->approved = Auth::user()->trusted ?? false;
                $link->save();
                session()->flash('success', 'El link se ha creado exitosamente.');

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
