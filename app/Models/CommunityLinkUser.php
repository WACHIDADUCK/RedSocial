<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CommunityLinkUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'community_link_id'
    ];

    public function toggle($link){
    // Guarda en una variable si: 
            // - Devuelve si lo encuentra por la id
            // - Y si no lo, crea uno
    $vote = CommunityLinkUser::firstOrNew(['user_id' => Auth::id(), 'community_link_id' => $link->id]);

    // Si al encontrarlo, porque debe tener id proveniente de la base de datos...
    if ($vote->id)
    // ...lo elimina...
    $vote->delete();
    else
    // ...y si no, lo guarda en la base de datos
    $vote->save();
    

    // vuelve a la pagina anterior, o desde donde hizo el post
    return back();
    }

}