<?php

    namespace Database\Factories\Acl;


    use App\Models\Acl\Permission;
    use Illuminate\Database\Eloquent\Factories\Factory;

    class PermissionFactory extends Factory
    {
        /**
         * The name of the factory's corresponding model.
         *
         * @var string
         */
        protected $model = Permission::class;

        /**
         * Define the model's default state.
         *
         * @return array
         */
        public function definition()
        {
            return [
                'name' => $this->faker->unique()->word . "." . $this->faker->word,
                'description' => $this->faker->sentence,
            ];
        }
    }
