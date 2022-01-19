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
            'name' => 'Leonel',
            'email' => 'leonellopez647@gmail.com',
            'password' => Hash::make('Leonel23'),
            'name' => 'Leonel',
            'email_verified_at' => now(),
        ]);
        $admin->assignRole($roleAdmin);

        $user = User::create([
            'name' => 'Leonel',
            'email' => 'lopezleonel191@gmail.com',
            'password' => Hash::make('Leonel23'),
            'name' => 'Leonel',
            'email_verified_at' => now(),
        ]);
        $user->assignRole($roleUser);
    }
}
