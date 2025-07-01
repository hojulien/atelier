<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Map;

class MapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // using a JSON file to create the data
        $dataPath = database_path('data/maps.json');
        $data = file_get_contents($dataPath);
        $maps = collect(json_decode($data, true));
        
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
