<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Suggestion;

class SuggestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suggestions = [
            [
                'type' => 'music',
                'description' => 'trust me this is a good link',
                'media' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'user_id' => 1,
            ],
        ];

        foreach ($suggestions as $suggestion) {
            Suggestion::create([
                'type' => $suggestion['type'],
                'description' => $suggestion['description'],
                'media' => $suggestion['media'],
                'user_id' => $suggestion['user_id']
            ]);
        }
    }
}
