<?php

use App\User;
use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=User::create([
            'first_name' => 'Jhon',
            'last_name' => 'Doe',
            'client_id'=>rand(3,1000),
            'organization_name' => 'example organization',
            'street' => 'Fusce Rd',
            'city' => 'Frederick Nebraska',
            'email' => 'admin@mail.com',
            'mobile' => '012345678900',
            'password' => Hash::make('password'),
        ]);
        $user->roles()->attach(Role::where('slug','super-admin')->first()->id);
    }
}
