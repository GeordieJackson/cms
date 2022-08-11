<?php

    namespace Database\SeedersORIG;

    use App\Models\Posts\Post;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class StaticPostsSeeder extends Seeder
    {
        /**
         * Run the database Seeders.
         *
         * @return void
         */
        public function run()
        {
            DB::table('posts')->truncate();

            DB::table('posts')->insert([
                'owner_id' => 1,
                'type' => Post::PAGE,
                'slug' => 'index',
                'meta_title' => "Critical Thinking",
                'title' => 'Critical Thinking',
                'body' => "This is the homepage",
                'published' => 1,
            ]);
        }
    }
