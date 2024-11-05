<?php

namespace App\Queries;

use App\Models\CommunityLink;
use App\Models\Channel;

class CommunityLinkQuery
{
    public function getByChannel($channel)
    {
        return $channel->communityLinks()->where('approved', 1)->latest('updated_at')->paginate(25);
    }
    public function getAll()
    {
        return CommunityLink::where('approved', 1)->latest('updated_at')->paginate(25);
    }

    public function getMostPopular()
    {
        return CommunityLink::where('approved', 1)->withCount("community_link_users")->orderBy('community_link_users_count', 'desc')->paginate(25);
    }

    public function getMostPopularChannel($channel)
    {
        return $channel->communityLinks()
        ->where('approved', 1)
        ->withCount("community_link_users")
        ->orderBy('community_link_users_count', 'desc')
        ->paginate(25);
    }
}
