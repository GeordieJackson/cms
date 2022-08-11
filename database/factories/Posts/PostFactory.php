<?php

    namespace Database\Factories\Posts;

    use App\Models\Categories\Category;
    use App\Models\Posts\Post;
    use App\Models\TemporalNames\TemporalName;
    use App\Models\Users\User;
    use Carbon\Carbon;
    use Illuminate\Database\Eloquent\Factories\Factory;

    class PostFactory extends Factory
    {
        /**
         * The name of the factory's corresponding model.
         *
         * @var string
         */
        protected $model = Post::class;

        /**
         * Define the model's default state.
         *
         * @return array
         */
        public function definition()
        {
            $type = $this->faker->numberBetween(1, 3);
            $temporal_id = $type == 1 ? TemporalName::factory()->create()->id : null;

            return [
                'owner_id' => function () {
                    return User::factory()
                        ->create()->id;
                },
                'category_id' => null,
                'slug' => $this->faker->unique()->slug,
                'type' => $type,
                'temporal_id' => $temporal_id,
                'meta_title' => $this->faker->title,
                'meta_description' => $this->faker->sentence,
                'meta_keywords' => $this->faker->words(5, 1),
                'title' => $this->faker->sentence,
                'subtitle' => $this->faker->sentence,
                'summary' => $this->faker->sentence,
                'body' => $this->faker->paragraph,
                'pdf' => null,
                'published' => 1,
                'publication_date' => Carbon::now()
                    ->subtract('1 hour'),
                'sticky' => 0,
                'image' => null,
            ];
        }

        public function page()
        {
            return $this->state([
                'type' => Post::PAGE,
            ]);
        }

        public function categorized()
        {
            return $this->state([
                'type' => Post::CATEGORIZED,
                'category_id' => function () {
                    return Category::factory()
                        ->create()->id;
                },
            ]);
        }

        public function temporal()
        {
            return $this->state([
                'type' => Post::TEMPORAL,
                'temporal_id' => function () {
                    return TemporalName::factory()
                        ->create()->id;
                },
            ]);
        }

        public function temporalBlog()
        {
            return $this->state([
                'type' => Post::TEMPORAL,
                'temporal_id' => function () {
                    return TemporalName::factory()
                        ->blog()
                        ->create()->id;
                },
            ]);
        }

        public function temporalLatestNews()
        {
            return $this->state([
                'type' => Post::TEMPORAL,
                'temporal_id' => function () {
                    return TemporalName::factory()
                        ->latestNews()
                        ->create()->id;
                },
            ]);
        }
    }
