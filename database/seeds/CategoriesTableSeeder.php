<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //PHP Category
        DB::table('categories')->insert([
            'parent_id' => '0',
            'name' => 'PHP'
        ]);


        //JavaScript Category
        DB::table('categories')->insert([
            'parent_id' => '0',
            'name' => 'JavaScript'
        ]);



        //PHP Sub-Category
        DB::table('categories')->insert([
            'parent_id' => '1',
            'name' => 'Laravel'
        ]);


        //PHP Sub-Category
        DB::table('categories')->insert([
            'parent_id' => '1',
            'name' => 'CodeIgniter'
        ]);



        //JavaScript Sub-Category
        DB::table('categories')->insert([
            'parent_id' => '2',
            'name' => 'Angular'
        ]);

        //JavaScript Sub-Category
        DB::table('categories')->insert([
            'parent_id' => '2',
            'name' => 'React'
        ]);

    }
}
