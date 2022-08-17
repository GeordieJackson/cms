<?php
    
    namespace Database\Seeders;
    
    use Illuminate\Database\Seeder;
    
    class UsersTableSeeder extends Seeder
    {
        
        /**
         * Auto generated seed file
         *
         * @return void
         */
        public function run()
        {
            \DB::table('users')->delete();
            
            \DB::table('users')->insert([
                0 =>
                    [
                        'id' => 1,
                        'forename' => 'Ad',
                        'surname' => 'Min',
                        'email' => 'admin@cms.test',
                        'slug' => 'john-jackson',
                        'email_verified_at' => '2022-08*03 15:47:59',
                        'password' => '$2y$10$IrGxGa42RzzA3WJfoXGnF.f92fYPM9ZNNLZvp5CqvEWxtcvvfhGxy', // password
                        'two_factor_secret' => null,
                        'two_factor_recovery_codes' => null,
                        'remember_token' => '',
                        'current_team_id' => null,
                        'profile_photo_path' => null,
                        'created_at' => '2022-08*03 15:47:59',
                        'updated_at' => '2022-08*03 15:47:59',
                    ],
                1 =>
                    [
                        'id' => 2,
                        'forename' => 'Arthur',
                        'surname' => 'Bisquits',
                        'email' => 'arthur@bisquits.co.uk',
                        'slug' => 'arthur-bisquits',
                        'email_verified_at' => '2022-08*03 15:47:59',
                        'password' => '$2y$10$IrGxGa42RzzA3WJfoXGnF.f92fYPM9ZNNLZvp5CqvEWxtcvvfhGxy', // password
                        'two_factor_secret' => null,
                        'two_factor_recovery_codes' => null,
                        'remember_token' => 'L7tdAvou8S',
                        'current_team_id' => null,
                        'profile_photo_path' => null,
                        'created_at' => '2022-08*03 15:47:59',
                        'updated_at' => '2022-08*03 15:47:59',
                    ],
                2 =>
                    [
                        'id' => 3,
                        'forename' => 'Billy',
                        'surname' => 'Fustees',
                        'email' => 'billy@fustees.co.uk',
                        'slug' => 'billy-fustees',
                        'email_verified_at' => '2022-08*03 15:47:59',
                        'password' => '$2y$10$IrGxGa42RzzA3WJfoXGnF.f92fYPM9ZNNLZvp5CqvEWxtcvvfhGxy', // password
                        'two_factor_secret' => null,
                        'two_factor_recovery_codes' => null,
                        'remember_token' => 'B8ljcZtm1R',
                        'current_team_id' => null,
                        'profile_photo_path' => null,
                        'created_at' => '2022-08*03 15:47:59',
                        'updated_at' => '2022-05-04 11:43:33',
                    ],
            ]);
        }
    }