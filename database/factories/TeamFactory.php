<?php

    namespace Database\Factories;

    use App\Models\Team;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Carbon;

    class TeamFactory extends Factory
    {
        protected $model = Team::class;

        /**
         * Define the model's default state.
         *
         * @return array
         */
        public function definition()
        {
            return [
                'user_id' => $this->faker->randomNumber(),
                'name' => $this->faker->name,
                'personal_team' => $this->faker->boolean,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
    }
