<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::table('users')->insert([
            [
                'nip' => 1234,
                'name' => 'DONI',
                'role' => 'DIREKTUR',
                'password' => Hash::make('123456'),
            ],
            [
                'nip' => 1235,
                'name' => 'DONO',
                'role' => 'FINANCE',
                'password' => Hash::make('123456'),
            ],
            [
                'nip' => 1236,
                'name' => 'DONA',
                'role' => 'STAFF',
                'password' => Hash::make('123456'),
            ],
        ]);
    }
}
