<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommunityLinkForm;
use App\Models\CommunityLink;
use App\Queries\CommunityLinkQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->exists('link')) {
            // Muestra los que busca en la barra de busqueda
            $link = request()->input('link');
            $links = (new CommunityLinkQuery())->getByTitle($link);
        } else if (request()->exists('popular')) {
            // Muestra los populares
            $links = (new CommunityLinkQuery())->getMostPopular();
        } else {
            // Mostrar todos los links
            $links = (new CommunityLinkQuery())->getAll();
        }
        return response()->json($links, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommunityLinkForm  $request)
    {
        return $request;
        $data = $request->validated();

        // Crear una instancia de CommunityLink con los datos validados
        $communityLink = new CommunityLink($data);
        $communityLink->user_id = Auth::id();  // Asignar el ID del usuario actual

        // Verificar si el enlace ya ha sido enviado
        if ($communityLink->hasAlreadyBeenSubmitted()) {
            // Si el enlace ya existe, los mensajes flash ya han sido gestionados dentro de hasAlreadyBeenSubmitted
            return "Ya existe un link igual";
        }

        // Si el enlace es nuevo, aprobarlo si el usuario es de confianza y guardarlo
        $communityLink->approved = Auth::user()->trusted ?? false;  // Aprobar automáticamente si el usuario es de confianza
        $communityLink->save();

        return [
            'status' => 'success',
            'message' => 'Link already submitted',
            'data' => $data,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show($communitylink)
    {
        return response()->json((new CommunityLinkQuery())->findById($communitylink), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CommunityLink $communitylink)
    {
        $link = CommunityLink::find($communitylink->id);
        $linkAntiguo =  $link->replicate();;
        if($link->user_id != $communitylink->user_id ){
        return response()->json(['message' => 'No eres el propietario del link'], 404);
        }
        $link->update($request->all());
        $linkActualizado = CommunityLink::find($communitylink->id);
        return response()->json([
            'message' => 'Link Actualizado', 
            'linkActualizado' =>  $linkActualizado, 
            'linkAntiguo' => $linkAntiguo,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommunityLink $communitylink)
    {   
        $link = CommunityLink::find($communitylink->id);
        if($link->user_id != $communitylink->user_id ){
        return response()->json(['message' => 'No eres el propietario del link'], 404);
        }
        $link->delete();
        return response()->json(['message' => 'Link eliminado', 'link' => $link], 200);

    }
}
