<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        $admin = User::create([
        	'name' => 'Admin',
        	'email' => 'admin@gmail.com',
        	'password' => Hash::make('password'),
        ]);

        $guest = User::create([
        	'name' => 'Guest',
        	'email' => 'guest@gmail.com',
        	'password' => Hash::make('password'),
        ]);

        $admin->roles()->attach(Role::where('name', 'admin')->first());
        $guest->roles()->attach(Role::where('name', 'guest')->first());
    }
}
