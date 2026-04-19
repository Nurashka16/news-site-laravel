<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Создаём 15 фейковых статей
        Article::factory()->count(15)->create();
    }
}