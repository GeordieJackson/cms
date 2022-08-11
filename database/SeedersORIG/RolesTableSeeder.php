<?php

    namespace Database\SeedersORIG;

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class RolesTableSeeder extends Seeder
    {
        /**
         * Run the database Seeders.
         *
         * @return void
         */
        public function run()
        {
            DB::table('roles')->truncate();

            DB::table('roles')->insert([
                ['slug' => 'member', 'name' => 'Member', 'description' => 'Member'],
                ['slug' => 'author', 'name' => 'Author', 'description' => 'Author'],
                ['slug' => 'editor', 'name' => 'Editor', 'description' => 'Editor'],
                ['slug' => 'admin', 'name' => 'Admin', 'description' => 'System administrator - has all permissions'],
            ]);
        }
    }
