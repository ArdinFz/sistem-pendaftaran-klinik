<?php

namespace Database\Seeders;
use App\Models\Anggota;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        Anggota::create([
            'nama'=>'Khairul Ikhwan',
            'hp'=>'089456383833'
        ]);
        Anggota::create([
            'nama'=>'Maya Dewi Pratiwi',
            'hp'=>'081347896500'
        ]);
        Anggota::create([
            'nama'=>'Anwar',
            'hp'=>'085825358191'
        ]);
    }
}
