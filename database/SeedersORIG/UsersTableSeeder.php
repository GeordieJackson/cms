<?php

    namespace Database\SeedersORIG;

    use App\Models\Users\User;
    use Database\Factories\UserTeam;
    use Illuminate\Database\Seeder;

    class UsersTableSeeder extends Seeder
    {
        private $randomUsersCount = 0;

        protected $defaultUsers = [
            [
                'forename' => 'John',
                'surname' => 'Jackson',
                'slug'  => 'john-jackson',
                'email' => 'john@johnjackson.me.uk',
            ],
            [
                'forename' => 'Arthur',
                'surname' => 'Bisquits',
                'slug' => 'arthur-bisquits',
                'email' => 'arthur@bisquits.co.uk',
            ],
            [
                'forename' => 'Billy',
                'surname' => 'Fustees',
                'slug' => 'billy-fustees',
                'email' => 'billy@fustees.co.uk',
            ],
        ];

        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            foreach ($this->defaultUsers as $defaultUser) {
                User::factory()->create($defaultUser);
            }

            User::factory()->count($this->randomUsersCount)->create();
        }
    }
