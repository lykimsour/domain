<?php

use Illuminate\Database\Seeder;

class adminusertableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       		DB::table('adminusers')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'role_id' => '1',
            'status' => '1',
            'created_at' => new DateTime('now'),
            'updated_at' => new DateTime('now'),
             ]);
       		
    }
}
