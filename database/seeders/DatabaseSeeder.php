<?php

namespace Database\Seeders;

use App\Models\CommunityLink;
use Illuminate\Support\Facades\DB;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        DB::delete('delete from community_links');
        CommunityLink::factory(50)->create(); 
    }
}
