<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table(config('usersuite.db') . '.' . 'roles')->insert([
            'name' => 'admin',
            'label' => 'Site Administrator',
        ]);
        \DB::table(config('usersuite.db') . '.' . 'roles')->insert([
            'name' => 'user',
            'label' => 'Generic User',
        ]);
    }
}
