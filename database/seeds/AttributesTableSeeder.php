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
        \DB::table('roles')->insert([
            'name' => 'admin',
            'label' => 'Site Administrator',
            'level' => 100
        ]);

        \DB::table('roles')->insert([
            'name' => 'user',
            'label' => 'Generic User',
            'level' => 1
        ]);
    }
}
