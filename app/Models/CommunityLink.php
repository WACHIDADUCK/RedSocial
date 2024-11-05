<?php

namespace App\Models;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityLink extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'channel_id',
        'title',
        'link'
    ];

    public function hasAlreadyBeenSubmitted()
    {
        $existing = static::where('link', $this->link)->first();
        if ($existing) {
            if (Auth::user()->isTrusted()) {
                $existing->touch(); // Actualiza el timestap al actual (elocuent)
                if ($existing->approved == 0)
                $existing->approved = 1;
                $existing->save();
                session()->flash('success', 'The link already exists and its timestamp has been updated.');
                return true;
            } else {
                if ($existing->approved)
                    session()->flash('info', 'The link already exists and it is already approved but you are not a trusted user, so it will not be updated in the list.');
                else
                    session()->flash('info', 'The link already exists and it is pending for approval but you are not a trusted user, so it will not be updated in the list.');
            }
            return true;
        }
        return false;
    }

    public function community_link_users()
    {
        return $this->hasMany(CommunityLinkUser::class);
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'community_link_users');
    }
}
