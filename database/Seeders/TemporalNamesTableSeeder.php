<?php
    
    namespace Database\Seeders;
    
    use Illuminate\Database\Seeder;
    
    class TemporalNamesTableSeeder extends Seeder
    {
        
        /**
         * Auto generated seed file
         *
         * @return void
         */
        public function run()
        {
            \DB::table('temporal_names')->delete();
            
            \DB::table('temporal_names')->insert([
                0 =>
                    [
                        'id' => 1,
                        'name' => 'Blog',
                        'slug' => 'blog',
                        'active' => 0,
                        'created_at' => null,
                        'updated_at' => null,
                        'deleted_at' => null,
                    ],
                1 =>
                    [
                        'id' => 2,
                        'name' => 'Latest news',
                        'slug' => 'latest-news',
                        'active' => 0,
                        'created_at' => null,
                        'updated_at' => null,
                        'deleted_at' => null,
                    ],
                2 =>
                    [
                        'id' => 3,
                        'name' => 'Events',
                        'slug' => 'events',
                        'active' => 0,
                        'created_at' => null,
                        'updated_at' => null,
                        'deleted_at' => null,
                    ],
            ]);
        }
    }