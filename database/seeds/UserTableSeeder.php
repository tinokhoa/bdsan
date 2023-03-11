<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::tabale('user')->trunscate();
        App\User::creat([
        	'name' => 'saonam',
        	'mail' => 'saonamcomltd@gmail.com',
        	'password' => 123456,	
        ])
    }
}
