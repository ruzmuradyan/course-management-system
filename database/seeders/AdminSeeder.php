<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('pass@123'),
                'role' => 'admin',
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more admin users if needed
        ]);
//        $admin = User::create([
//           'name' => 'Admin',
//           'email' => 'admin@admin.com',
//           'password' => bcrypt('password'),
//        ]);
//
//        $adminRoleId = DB::table('roles')->where('name', 'admin')->value('id');
//
//        DB::table('role_user')->insert([
//            'role_id' => $adminRoleId,
//            'user_id' => $admin->id,
//        ]);
    }
}
