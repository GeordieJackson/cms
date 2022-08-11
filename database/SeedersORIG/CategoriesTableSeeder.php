<?php

    namespace Database\SeedersORIG;

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
  //          \DB::table('categories')->delete();

            \DB::table('categories')->insert([
                0 =>
                    [
                        'id' => 6,
                        'category_id' => 0,
                        'slug' => 'critical-thinking',
                        'name' => 'Critical thinking',
                        'count' => 0,
                    ],
                1 =>
                    [
                        'id' => 8,
                        'category_id' => 6,
                        'slug' => 'bad-arguments',
                        'name' => 'Bad Arguments',
                        'count' => 2,
                    ],
                2 =>
                    [
                        'id' => 9,
                        'category_id' => 6,
                        'slug' => 'fallacies',
                        'name' => 'fallacies',
                        'count' => 0,
                    ],
                3 =>
                    [
                        'id' => 11,
                        'category_id' => 9,
                        'slug' => 'informal-fallacies',
                        'name' => 'informal fallacies',
                        'count' => 2,
                    ],
                4 =>
                    [
                        'id' => 12,
                        'category_id' => 0,
                        'slug' => 'health',
                        'name' => 'Health',
                        'count' => 0,
                    ],
                5 =>
                    [
                        'id' => 13,
                        'category_id' => 12,
                        'slug' => 'alternative-medicine',
                        'name' => 'alternative mEdicine',
                        'count' => 0,
                    ],
            ]);
        }
    }
