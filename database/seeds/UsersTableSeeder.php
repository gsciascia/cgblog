<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Create fake data fro Admin e Author users
     *
     * @return void
     */
    public function run()
    {
        //Admin user
        DB::table('users')->insert([
            'role_id' => '1', // Admin
            'name' => 'Joe',
            'last_name' => 'Admin',
            'email' => 'admin@email.lol',
            'is_active' => 1,
            'password' => bcrypt('admin')
        ]);


        //Author user
        DB::table('users')->insert([
            'role_id' => '2', // Admin
            'name' => 'John',
            'last_name' => 'Author',
            'email' => 'author@email.lol',
            'is_active' => 1,
            'password' => bcrypt('author')
        ]);


        //Author user
        DB::table('users')->insert([
            'role_id' => '2', // Admin
            'name' => 'Jack',
            'last_name' => 'Author 2',
            'email' => 'author2@email.lol',
            'is_active' => 1,
            'password' => bcrypt('author2')
        ]);

    }
}
