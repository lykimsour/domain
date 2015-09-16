<?php

use Illuminate\Database\Seeder;

class roletableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'role_title' => 'Admin',
            'role_slug' => 'admin',
             ]);
		DB::table('roles')->insert([
            'role_title' => 'Cashier',
            'role_slug' => 'cashier',
             ]);
		DB::table('roles')->insert([
            'role_title' => 'Service',
            'role_slug' => 'service',
             ]);
		DB::table('roles')->insert([
            'role_title' => 'Online_Shop',
            'role_slug' => 'online_Shop',
             ]);
    }
}
