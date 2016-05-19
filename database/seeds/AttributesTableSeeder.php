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
        \DB::table(config('usersuite.db') . '.' . 'attributes')->insert([
            'name' => 'role',
            'label' => "Role of User",
            'is_unique' => 1
        ]);
        
        \DB::table(config('usersuite.db') . '.' . 'attributes')->insert([
            'name' => 'give_permission',
            'label' => 'Give Permission to User',
            'is_unique' => 0
        ]);

        \DB::table(config('usersuite.db') . '.' . 'attributes')->insert([
            'name' => 'remove_permission',
            'label' => 'Removes a Permission from a User',
            'is_unique' => 0
        ]);
    }
}
