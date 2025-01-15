<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $adviser1 = User::factory()->create([
            'name' => 'Kredium1',
            'email' => 'test@kredium1.com',
            'password' => Hash::make('password'),
        ]);

        $adviser2 = User::factory()->create([
            'name' => 'Kredium2',
            'email' => 'test@kredium2.com',
            'password' => Hash::make('password'),
        ]);
    }
}
