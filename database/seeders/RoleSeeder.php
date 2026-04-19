<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create([
            'name' => 'moderator',
            'description' => 'Модератор - полный доступ ко всем функциям',
        ]);

        Role::create([
            'name' => 'reader',
            'description' => 'Читатель - только просмотр и комментарии',
        ]);
    }
}