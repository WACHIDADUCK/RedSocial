<?php

namespace App\Http\Controllers;

use App\Models\CommunityLink;
use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommunityLinkForm;
use App\Queries\CommunityLinkQuery;

class CommunityLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Channel $channel = null)
    {
        // dd($channel);
        if (request()->exists('popular') && $channel) {
            // Muestra los populares
            $links = (new CommunityLinkQuery())->getMostPopularChannel($channel);
        }else if (request()->exists('popular')) {
            // Muestra los populares
            $links = (new CommunityLinkQuery())->getMostPopular();
        } else if ($channel) {
            // Filtrar los links por el canal
            $links = (new CommunityLinkQuery())->getByChannel($channel);
        } else {
            // Mostrar todos los links
            $links = (new CommunityLinkQuery())->getAll();
        }
        $channels = Channel::orderBy('title', 'asc')->get();
        return view('dashboard', compact('links', 'channels'));
    }

    public function myLinks()
    {
        $links = CommunityLink::where('approved', true)->latest('updated_at')->paginate(10);
        $channels = Channel::orderBy('title', 'asc')->get();
        return view("mylinks", compact('links', 'channels'));
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

        // Crear una instancia de CommunityLink con los datos validados
        $communityLink = new CommunityLink($data);
        $communityLink->user_id = Auth::id();  // Asignar el ID del usuario actual

        // Verificar si el enlace ya ha sido enviado
        if ($communityLink->hasAlreadyBeenSubmitted()) {
            // Si el enlace ya existe, los mensajes flash ya han sido gestionados dentro de hasAlreadyBeenSubmitted
            return back();
        }

        // Si el enlace es nuevo, aprobarlo si el usuario es de confianza y guardarlo
        $communityLink->approved = Auth::user()->trusted ?? false;  // Aprobar automáticamente si el usuario es de confianza
        $communityLink->save();

        // Mensaje de éxito si el enlace fue creado
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
