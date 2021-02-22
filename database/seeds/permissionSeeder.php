<?php

use App\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class permissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::updateOrCreate([
            'name'=>'Generate Key',
            'slug'=>'generate.key',
        ]);
    }
}
