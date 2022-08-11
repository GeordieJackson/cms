<?php

    namespace Database\Factories\Users;

    use App\Models\Team;
    use App\Models\Users\User;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Str;
    use function now;

    class UserFactory extends Factory
    {
        /**
         * The name of the factory's corresponding model.
         *
         * @var string
         */
        protected $model = User::class;

        /**
         * Define the model's default state.
         *
         * @return array
         */
        public function definition()
        {
            return [
                'forename' => $forename = $this->faker->firstName,
                'surname' => $surname = $this->faker->unique()->lastName,
                'slug' => Str::slug($forename . " " . $surname, "-"),
                'email' => $this->faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ];
        }

        public function configure()
        {
            return $this->afterCreating(function (User $user) {
                Team::factory()->create([
                    'user_id' => $user->id,
                    'name' => $user->forename . "'s Team",
                    'personal_team' => true,
                ]);
            });
        }
    }
