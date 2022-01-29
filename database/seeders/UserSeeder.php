<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::findOrFail(1);
        $roleUser = Role::findOrFail(2);

        $admin = User::create([
            'id' => 1,
            'name' => 'Leonel',
            'last_name' => 'Lopez',
            'dui' => '12345678-1',
            'email' => 'leonellopez647@gmail.com',
            'password' => Hash::make('Leonel23'),
            'name' => 'Leonel',
            'email_verified_at' => now(),
        ]);
        $admin->assignRole($roleAdmin);

        $user = User::create([
            'id' => 2,
            'name' => 'Leonel',
            'last_name' => 'Lopez',
            'dui' => '12345678-2',
            'email' => 'lopezleonel191@gmail.com',
            'password' => Hash::make('Leonel23'),
            'name' => 'Leonel',
            'email_verified_at' => now(),
        ]);
        $user->assignRole($roleUser);

        $user = User::create([
            'id' => 3,
            'name' => 'admin',
            'last_name' => 'admin',
            'dui' => '02475605-7',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'name' => 'William',
            'email_verified_at' => now(),
        ]);
        $user->assignRole($roleAdmin);
    }
}
