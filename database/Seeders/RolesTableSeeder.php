<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'slug' => 'member',
                'name' => 'Member',
                'description' => 'Member',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'slug' => 'author',
                'name' => 'Author',
                'description' => 'Author',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'slug' => 'editor',
                'name' => 'Editor',
                'description' => 'Editor',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'slug' => 'admin',
                'name' => 'Admin',
                'description' => 'System administrator - has all permissions',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}