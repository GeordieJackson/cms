<?php

    namespace Database\SeedersORIG;

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class PermissionsTableSeeder extends Seeder
    {
        /**
         * Run the database Seeders.
         *
         * @return void
         */
        public function run()
        {
            //DB::table('permissions')->truncate();

            DB::table('permissions')->insert([
                ['name' => 'manage.posts', 'description' => 'Ability to update all content'],
                ['name' => 'manage.users', 'description' => 'Ability to update all users'],
                ['name' => 'manage.categories', 'description' => ''],
                ['name' => 'manage.acl', 'description' => ''],
                ['name' => 'see.dashboard', 'description' => ''],
            ]);
        }
    }
