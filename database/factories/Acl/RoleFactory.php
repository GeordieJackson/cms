<?php

    namespace Database\Factories\Acl;


    use App\Models\Acl\Role;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use function strtolower;
    use function ucfirst;

    class RoleFactory extends Factory
    {
        /**
         * The name of the factory's corresponding model.
         *
         * @var string
         */
        protected $model = Role::class;

        /**
         * Define the model's default state.
         *
         * @return array
         */
        public function definition()
        {
            return [
                'slug' => $name = strtolower($this->faker->unique()->word),
                'name' => ucfirst($name),
                'description' => $this->faker->sentence,
            ];
        }
    }
