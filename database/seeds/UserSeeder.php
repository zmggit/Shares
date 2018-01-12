<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\User::create([
            'name'=>'admins',
            'phone'=>'123456789',
            'password'=>bcrypt('123456'),

        ]);
        \App\Model\User::create([
            'name'=>'root',
            'phone'=>'110120119',
            'password'=>bcrypt('123456'),

        ]);
        \App\Model\User::create([
            'name'=>'张三',
            'phone'=>'1457895123',
            'password'=>bcrypt('123456'),

        ]);
    }
}
