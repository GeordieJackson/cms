<?php
    
    namespace Database\Seeders;
    
    use Illuminate\Database\Seeder;
    
    class RoleUserTableSeeder extends Seeder
    {
        
        /**
         * Auto generated seed file
         *
         * @return void
         */
        public function run()
        {
            \DB::table('role_user')->delete();
            
            \DB::table('role_user')->insert([
//                0 =>
//                    [
//                        'role_id' => 2,
//                        'user_id' => 2,
//                    ],
//                1 =>
//                    [
//                        'role_id' => 3,
//                        'user_id' => 3,
//                    ],
                2 =>
                    [
                        'role_id' => 4,
                        'user_id' => 1,
                    ],
            ]);
        }
    }