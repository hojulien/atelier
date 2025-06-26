<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Playlist;

class PlaylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $playlists = [
            [
                'name' => 'chill playlist',
                'number_levels' => 0,
                'description' => 'practically all the relaxing maps i\'ve made since 2014. contains tags that you can filter by, too!',
                'type' => 'admin',
                'user_id' => 1
            ],
            [
                'name' => 'seiga nyannyan',
                'number_levels' => 0,
                'description' => 'i love seiga',
                'type' => 'user',
                'user_id' => 2
            ],
        ];

        foreach ($playlists as $playlist) {
            Playlist::create([
                'name' => $playlist['name'],
                'number_levels' => $playlist['number_levels'],
                'description' => $playlist['description'],
                'type' => $playlist['type'],
                'user_id' => $playlist['user_id'] 
            ]);
        }
    }
}
