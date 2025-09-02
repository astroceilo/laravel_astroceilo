<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Patient;
use App\Models\Hospital;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'username' => 'admin',
            'name' => 'admin',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $rs1 = Hospital::create([
            'name' => 'RS Harapan Bunda',
            'address' => 'Jl. Merdeka No. 1',
            'email' => 'harapanbunda@mail.com',
            'phone' => '021123456',
        ]);

        $rs2 = Hospital::create([
            'name' => 'RS Kasih Ibu',
            'address' => 'Jl. Sudirman No. 10',
            'email' => 'kasihibu@mail.com',
            'phone' => '021987654',
        ]);

        Patient::create([
            'name' => 'Budi',
            'address' => 'Jl. Mawar 123',
            'phone' => '08123456789',
            'hospital_id' => $rs1->id,
        ]);

        Patient::create([
            'name' => 'Siti',
            'address' => 'Jl. Melati 45',
            'phone' => '08234567890',
            'hospital_id' => $rs2->id,
        ]);
    }
}
