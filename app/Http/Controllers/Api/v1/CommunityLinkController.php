<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\CommunityLink;
use App\Queries\CommunityLinkQuery;
use Illuminate\Http\Request;


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
        }else if  (request()->exists('popular')) {
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show( $communitylink)
    {   
        return response()->json((new CommunityLinkQuery())->findById($communitylink), 200);
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
