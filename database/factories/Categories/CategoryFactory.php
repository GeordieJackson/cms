<?php

    namespace Database\Factories\Categories;

    use App\Models\Categories\Category;
    use Illuminate\Database\Eloquent\Factories\Factory;

    class CategoryFactory extends Factory
    {
        /**
         * The name of the factory's corresponding model.
         *
         * @var string
         */
        protected $model = Category::class;

        /**
         * Define the model's default state.
         *
         * @return array
         */
        public function definition()
        {
            return [
                'slug' => $this->faker->unique()->word,
                'name' => $this->faker->unique()->word,
                'category_id' => 0,
            ];
        }

        public function tests()
        {
            return [
                ['id' => 1, 'category_id' => 0, 'slug' => 'critical-thinking', 'name' => 'Critical Thinking'],
                ['id' => 2, 'category_id' => 1, 'slug' => 'bad-arguments', 'name' => 'Bad Arguments'],
                ['id' => 3, 'category_id' => 1, 'slug' => 'fallacies', 'name' => 'Fallacies'],
                ['id' => 4, 'category_id' => 3, 'slug' => 'formal-fallacies', 'name' => 'Formal fallacies'],
                ['id' => 5, 'category_id' => 3, 'slug' => 'informal-fallacies', 'name' => 'informal fallacies'],
                ['id' => 6, 'category_id' => 0, 'slug' => 'alternative-medicine', 'name' => 'alternative medicine'],
                ['id' => 7, 'category_id' => 6, 'slug' => 'homeopathy', 'name' => 'homeopathy'],
                ['id' => 8, 'category_id' => 0, 'slug' => 'multi-level-marketing', 'name' => 'multi level marketing'],
            ];
        }
    }
