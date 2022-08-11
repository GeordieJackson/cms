<?php

    namespace Database\SeedersORIG;

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\Schema;

    class DatabaseSeeder extends Seeder
    {
        /**
         * Seed the application's database.
         *
         * @return void
         */
        public function run()
        {
            Schema::disableForeignKeyConstraints();
            $this->call(UsersTableSeeder::class);
            $this->call(StaticPostsSeeder::class);
            $this->call(PostsTableSeeder::class);
            $this->call(RolesTableSeeder::class);
            $this->call(PermissionsTableSeeder::class);
            $this->call(role_user_table_seeder::class);
            $this->call(permission_role_table_seeder::class);
            $this->call(TemporalNamesTableSeeder::class);
            $this->call(CategoriesTableSeeder::class);
            Schema::enableForeignKeyConstraints();
        }
    }
