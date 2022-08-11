<?php

    namespace App\Actions\Fortify;

    use App\Models\Team;
    use App\Models\Users\User;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Str;
    use Laravel\Fortify\Contracts\CreatesNewUsers;

    class CreateNewUser implements CreatesNewUsers
    {
        use PasswordValidationRules;

        /**
         * Create a newly registered user.
         *
         * @param array $input
         * @return \App\Models\Users\User
         */
        public function create(array $input)
        {
            Validator::make($input, [
                'forename' => ['required', 'string', 'max:255'],
                'surname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => $this->passwordRules(),
            ])->validate();

            return DB::transaction(function () use ($input) {
                return tap(User::create([
                    'forename' => $input['forename'],
                    'surname' => $input['surname'],
                    'slug' => Str::slug($input['forename'] . " " . $input['surname'], "-"),
                    'email' => $input['email'],
                    'password' => Hash::make($input['password']),
                ]), function (User $user) {
                    $this->createTeam($user);
                });
            });
        }

        /**
         * Create a personal team for the user.
         *
         * @param \App\Models\Users\User $user
         * @return void
         */
        protected function createTeam(User $user)
        {
            $user->ownedTeams()->save(Team::forceCreate([
                'user_id' => $user->id,
                //   'name' => explode(' ', $user->name, 2)[0] . "'s Team",
                'name' => explode(' ', $user->name, 2)[0] . "'s Team",
                'personal_team' => true,
            ]));
        }
    }
