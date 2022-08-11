<?php

    namespace Database\SeedersORIG;

    use App\Models\Acl\Role;
    use App\Models\Users\User;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class role_user_table_seeder extends Seeder
    {
        /**
         * Run the database Seeders.
         *
         * @return void
         */
        public function run()
        {
            DB::table('role_user')->truncate();

            DB::table('role_user')->insert([
                ['role_id' => Role::where('name', 'admin')->value('id'), 'user_id' => User::where('email', 'john@johnjackson.me.uk')->value('id')],
                ['role_id' => Role::where('name', 'editor')->value('id'), 'user_id' => User::where('email', 'billy@fustees.co.uk')->value('id')],
                ['role_id' => Role::where('name', 'author')->value('id'), 'user_id' => User::where('email', 'arthur@bisquits.co.uk')->value('id')],
            ]);
        }
    }
