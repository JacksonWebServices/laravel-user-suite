<?php

use Illuminate\Database\Seeder;

class AttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('attributes')->insert([
            'name' => 'give_permission',
            'label' => 'Give Permission to User',
        ]);

        \DB::table('roles')->insert([
            'name' => 'remove_permission',
            'label' => 'Removes a Permission from a User',
        ]);
    }
}
