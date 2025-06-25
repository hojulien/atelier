<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Map;

class MapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $maps = require database_path('data/maps_data.php');
        foreach ($maps as $map) {
            Map::create([
                'rc' => $map['rc'],
                'artist' => $map['artist'],
                'title' => $map['title'],
                'artistUnicode' => $map['artistUnicode'],
                'titleUnicode' => $map['titleUnicode'],
                'creator' => $map['creator'],
                'sr' => $map['sr'],
                'length' => $map['length'],
                'cs' => $map['cs'],
                'hp' => $map['hp'],
                'ar' => $map['ar'],
                'od' => $map['od'],
                'setId' => $map['setId'],
                'mapId' => $map['mapId'],
                'submitDate' => $map['submitDate'],
                'lastUpdated' => $map['lastUpdated'],
                'tags' => $map['tags'],
                'background' => $map['background']
            ]);
        }
    }
}
