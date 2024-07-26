<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'Humor',
            'Terror',
            'Divertido',
            'DesenhoRealista',
            'Retrato',
            'Desenho3D',
            'ArteMinimalista',
            'Esboço',
            'DesenhoAnime',
            'PinturaDigital',
        ];

        foreach ($tags as $tag) {
            Tag::updateOrCreate(
                ['name' => $tag],
                ['name' => $tag]
            );
        }

    }
}
