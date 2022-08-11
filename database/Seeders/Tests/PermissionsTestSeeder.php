<?php

    namespace Database\Seeders\Tests;

    use Illuminate\Database\Seeder;

    class PermissionsTestSeeder extends Seeder
    {
        /**
         * Run the database Seeders.
         *
         * @return void
         */
        public function run()
        {
            DB::table('permissions')->delete();

            DB::table('permissions')->insert([
                'name' => 'test.permission',
                'description' => 'Permission used for testing',
            ]);
        }
    }
