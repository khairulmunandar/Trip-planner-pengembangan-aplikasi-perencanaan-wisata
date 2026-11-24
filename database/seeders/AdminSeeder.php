<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Akun admin default:
     * email: admin@tripplanner.com
     * password: admin123
     */
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'admin@tripplanner.com'],
            [
                'nama' => 'Administrator',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}
