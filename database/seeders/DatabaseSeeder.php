<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        $moderatorRole = Role::where('name', 'moderator')->first();
        $readerRole = Role::where('name', 'reader')->first();

        User::create([
            'name' => 'Модератор',
            'email' => 'moderator@news.ru',
            'password' => Hash::make('moderator123'),
            'role_id' => $moderatorRole->id,
        ]);

        User::create([
            'name' => 'Читатель',
            'email' => 'reader@news.ru',
            'password' => Hash::make('reader123'),
            'role_id' => $readerRole->id,
        ]);

        Article::factory()->count(15)->create();
    }
}