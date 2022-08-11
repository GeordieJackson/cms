<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tags')->delete();
        
        \DB::table('tags')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Homeopathy',
                'slug' => 'homeopathy',
                'created_at' => '2021-05-14 09:32:01',
                'updated_at' => '2021-05-14 09:32:01',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Scam',
                'slug' => 'scam',
                'created_at' => '2021-05-14 09:32:01',
                'updated_at' => '2021-05-14 09:32:01',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Alternative medicine',
                'slug' => 'alternative-medicine',
                'created_at' => '2021-05-14 09:32:01',
                'updated_at' => '2021-05-14 09:32:01',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Testing',
                'slug' => 'testing',
                'created_at' => '2021-05-15 16:49:01',
                'updated_at' => '2021-05-15 16:49:01',
            ),
        ));
        
        
    }
}