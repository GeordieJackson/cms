<?php

    namespace Database\Seeders\Tests;

    use Illuminate\Database\Seeder;

    class CategoriesTestSeeder extends Seeder
    {
        /**
         * Run the database Seeders.
         *
         * @return void
         */
        public function run()
        {
            \DB::table('categories')->insert([
                0 => [
                    'id' => 1,
                    'category_id' => 0,
                    'slug' => 'conspiracy-theories',
                    'name' => 'conspiracy-theories',
                    #   'count' => 0
                ],
                1 => [
                    'id' => 2,
                    'category_id' => 0,
                    'slug' => 'critical-thinking',
                    'name' => 'critical-thinking',
                    #   'count' => 0
                ],
                2 => [
                    'id' => 3,
                    'category_id' => 0,
                    'slug' => 'general-content',
                    'name' => 'general-content',
                    #   'count' => 0
                ],
                3 => [
                    'id' => 4,
                    'category_id' => 0,
                    'slug' => 'health',
                    'name' => 'health',
                ],
                4 => [
                    'id' => 5,
                    'category_id' => 0,
                    'slug' => 'lifestyle-issues',
                    'name' => 'lifestyle-issues',
                    #   'count' => 0
                ],
                5 => [
                    'id' => 6,
                    'category_id' => 0,
                    'slug' => 'paranormal',
                    'name' => 'paranormal',
                    #   'count' => 0
                ],
                6 => [
                    'id' => 7,
                    'category_id' => 0,
                    'slug' => 'pseudoscience',
                    'name' => 'pseudoscience',
                    #   'count' => 0
                ],
                7 => [
                    'id' => 8,
                    'category_id' => 0,
                    'slug' => 'psychology',
                    'name' => 'psychology',
                    #   'count' => 0
                ],
                8 => [
                    'id' => 9,
                    'category_id' => 2,
                    'slug' => 'bad-arguments',
                    'name' => 'bad-arguments',
                    #   'count' => 0
                ],
                9 => [
                    'id' => 10,
                    'category_id' => 2,
                    'slug' => 'fallacies',
                    'name' => 'fallacies',
                    #   'count' => 0
                ],
                10 => [
                    'id' => 11,
                    'category_id' => 10,
                    'slug' => 'formal-fallacies',
                    'name' => 'formal-fallacies',
                    #   'count' => 0
                ],
                11 => [
                    'id' => 12,
                    'category_id' => 10,
                    'slug' => 'informal-fallacies',
                    'name' => 'informal-fallacies',
                    #   'count' => 0
                ],
                12 => [
                    'id' => 13,
                    'category_id' => 3,
                    'slug' => 'humour',
                    'name' => 'humour',
                    #   'count' => 0
                ],
                13 => [
                    'id' => 14,
                    'category_id' => 4,
                    'slug' => 'alternative-medicine',
                    'name' => 'alternative-medicine',
                    #   'count' => 0
                ],
                14 => [
                    'id' => 15,
                    'category_id' => 14,
                    'slug' => 'acupuncture',
                    'name' => 'acupuncture',
                    #   'count' => 0
                ],
                15 => [
                    'id' => 16,
                    'category_id' => 14,
                    'slug' => 'homeopathy',
                    'name' => 'homeopathy',
                    #   'count' => 0
                ],
                16 => [
                    'id' => 17,
                    'category_id' => 6,
                    'slug' => 'psychics',
                    'name' => 'psychics',
                    #   'count' => 0
                ],
                17 => [
                    'id' => 18,
                    'category_id' => 17,
                    'slug' => 'derek-ogilvie',
                    'name' => 'derek-ogilvie',
                    #   'count' => 0
                ],
                18 => [
                    'id' => 19,
                    'category_id' => 6,
                    'slug' => 'near-death-experiences',
                    'name' => 'near-death-experiences',
                    #   'count' => 0
                ],
                19 => [
                    'id' => 20,
                    'category_id' => 6,
                    'slug' => 'spiritualism',
                    'name' => 'spiritualism',
                    #   'count' => 0
                ],
                20 => [
                    'id' => 21,
                    'category_id' => 6,
                    'slug' => 'astrology',
                    'name' => 'astrology',
                    #   'count' => 0
                ],
                21 => [
                    'id' => 22,
                    'category_id' => 17,
                    'slug' => 'diane-lazarus',
                    'name' => 'diane-lazarus',
                    #   'count' => 0
                ],
                22 => [
                    'id' => 23,
                    'category_id' => 5,
                    'slug' => 'money-and-finance',
                    'name' => 'money-and-finance',
                    #   'count' => 0
                ],
                23 => [
                    'id' => 24,
                    'category_id' => 5,
                    'slug' => 'scams-and-hoaxes',
                    'name' => 'scams-and-hoaxes',
                    #   'count' => 0
                ],
                24 => [
                    'id' => 25,
                    'category_id' => 5,
                    'slug' => 'multi-level-marketing',
                    'name' => 'multi-level-marketing',
                    #   'count' => 0
                ],
                25 => [
                    'id' => 26,
                    'category_id' => 14,
                    'slug' => 'chiropractic',
                    'name' => 'chiropractic',
                    #   'count' => 0
                ],
                26 => [
                    'id' => 27,
                    'category_id' => 14,
                    'slug' => 'herbal-medicine',
                    'name' => 'herbal-medicine',
                    #   'count' => 0
                ],
                27 => [
                    'id' => 28,
                    'category_id' => 7,
                    'slug' => 'pseudohistory',
                    'name' => 'pseudohistory',
                    #   'count' => 0
                ],
                28 => [
                    'id' => 29,
                    'category_id' => 2,
                    'slug' => 'errors-of-reasoning',
                    'name' => 'errors-of-reasoning',
                    #   'count' => 0
                ],
            ]);
        }
    }
