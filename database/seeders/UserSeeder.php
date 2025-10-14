<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (env('APP_ENV') == 'local') {
            User::truncate();
        }
        
        $data = [];
        $data = array_merge($data, [
            [
                'name' => 'Super Admin',
                'email' => 'opsitravel@gmail.com',
                'password' => bcrypt('Password123!'),
                'plain_text' => 'Password123!',
                'phone' => '081234698453',
                'nationality' => 'Indonesia',
                'role' => 1,
                'status' => 1,
                'created_at' => now()
            ]
        ]);

        if (!empty($data)) {
            User::insert($data);
        }
    }
}
