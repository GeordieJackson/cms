<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 6,
                'category_id' => 0,
                'slug' => 'critical-thinking',
                'name' => 'Critical thinking',
                'count' => 0,
            ),
            1 => 
            array (
                'id' => 8,
                'category_id' => 6,
                'slug' => 'bad-arguments',
                'name' => 'Bad Arguments',
                'count' => 2,
            ),
            2 => 
            array (
                'id' => 9,
                'category_id' => 6,
                'slug' => 'fallacies',
                'name' => 'Fallacies',
                'count' => 0,
            ),
            3 => 
            array (
                'id' => 11,
                'category_id' => 9,
                'slug' => 'informal-fallacies',
                'name' => 'informal fallacies',
                'count' => 2,
            ),
            4 => 
            array (
                'id' => 12,
                'category_id' => 0,
                'slug' => 'health',
                'name' => 'Health',
                'count' => 0,
            ),
            5 => 
            array (
                'id' => 13,
                'category_id' => 12,
                'slug' => 'alternative-medicine',
                'name' => 'Alternative medicine',
                'count' => 0,
            ),
        ));
        
        
    }
}