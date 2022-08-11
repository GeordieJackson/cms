<?php

    namespace Database\Factories\TemporalNames;

    use App\Models\TemporalNames\TemporalName;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Str;

    class TemporalNameFactory extends Factory
    {
        /**
         * The name of the factory's corresponding model.
         *
         * @var string
         */
        protected $model = TemporalName::class;

        /**
         * Define the model's default state.
         *
         * @return array
         */
        public function definition()
        {
            $word = $this->faker->word;

            return [
                'name' => $word,
                'slug' => Str::slug($word),
                'active' => 1,
            ];
        }

        public function blog()
        {
            return $this->state([
                'name' => 'blog',
                'slug' => 'blog',
            ]);
        }

        public function latestNews()
        {
            return $this->state([
                'name' => 'Latest news',
                'slug' => 'latest-news'
            ]);
        }
    }
