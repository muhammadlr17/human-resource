<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'first_name' => 'admin',
                'last_name' => 'alton',
                'username' => 'adminalton',
                'email' => 'admin@admin.com',
                'phone' => '087888777999',
                'photo' => '',
                'company_id' => '1',
                'departement_id' => '1',
                'password' => 'password123',
                'role' => 'admin'
            ],
            [
                'first_name' => 'user',
                'last_name' => 'alton',
                'username' => 'useralton',
                'email' => 'user@user.com',
                'phone' => '08777788097',
                'photo' => '',
                'company_id' => '1',
                'departement_id' => '2',
                'password' => 'password123',
                'role' => 'user'
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
