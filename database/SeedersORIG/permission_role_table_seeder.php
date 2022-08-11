<?php

    namespace Database\SeedersORIG;

    use App\Models\Acl\Permission;
    use App\Models\Acl\Role;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class permission_role_table_seeder extends Seeder
    {
        /**
         * Run the database Seeders.
         *
         * @return void
         */
        public function run()
        {
            DB::table('permission_role')->truncate();

            DB::table('permission_role')->insert([
                ['role_id' => Role::where('name', 'author')->value('id'), 'permission_id' => Permission::where('name', 'see.dashboard')->value('id')],
                ['role_id' => Role::where('name', 'editor')->value('id'), 'permission_id' => Permission::where('name', 'see.dashboard')->value('id')],
                ['role_id' => Role::where('name', 'editor')->value('id'), 'permission_id' => Permission::where('name', 'manage.posts')->value('id')],
            ]);
        }
    }
