<?php

    namespace Database\SeedersORIG;

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class TemporalNamesTableSeeder extends Seeder
    {
        /**
         * Run the database Seeders.
         *
         * @return void
         */
        public function run()
        {
            DB::table('temporal_names')->truncate();

            DB::table('temporal_names')->insert([
                [
                    'name' => 'Blog',
                    'slug' => 'blog',
                    'active' => 1,
                ],
                [
                    'name' => 'Latest news',
                    'slug' => 'latest-news',
                    'active' => 1,
                ],
                [
                    'name' => 'Events',
                    'slug' => 'events',
                    'active' => 0,
                ]
            ]);
        }
    }
