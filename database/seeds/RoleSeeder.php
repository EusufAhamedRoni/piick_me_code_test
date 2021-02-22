<?php

use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'=>'Super Admin',
            'slug'=>Str::slug('Super Admin')
        ]);
        Role::create([
            'name'=>'User',
            'slug'=>Str::slug('User')
        ]);
    }
}
