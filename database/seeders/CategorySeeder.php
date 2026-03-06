<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Actualité', 'slug' => 'actualite'],
            ['name' => 'Recherche', 'slug' => 'recherche'],
            ['name' => 'Événement', 'slug' => 'evenement'],
            ['name' => 'Ressources', 'slug' => 'ressources'],
            ['name' => 'Conseils', 'slug' => 'conseils'],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
