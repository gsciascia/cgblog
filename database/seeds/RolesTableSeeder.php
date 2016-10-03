<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Create base role admin and author
     *
     * @return void
     */
    public function run()
    {
        //Admin
        DB::table('roles')->insert([
            'name' => 'admin', // Admin
        ]);

        //Author
        DB::table('roles')->insert([
            'name' => 'author', // Author
        ]);

    }
}
