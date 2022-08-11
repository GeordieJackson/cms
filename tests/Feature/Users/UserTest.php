<?php

    namespace Tests\Feature\Users;

    use App\Models\Users\User;
    use Facades\Tests\Setup\UserRoleFactory;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;

    class UserTest extends TestCase
    {
        use RefreshDatabase;
    
        /**
         *  NOTE: Registration is currently disabled
         */

//        /**
//         * @test
//         */
//        public function the_registration_page_displays_ok()
//        {
//            $this->get(route('register'))->assertOk()->assertViewIs('auth.register');
//        }
//
//        /**
//         * @test
//         */
//        public function a_user_can_register()
//        {
//            $this->post(route('register'), [
//                'forename' => 'John',
//                'surname' => 'Jackson',
//                'email' => 'john@johnjackson.me.uk',
//                'password' => '12345678',
//                'password_confirmation' => '12345678',
//            ])
//            //    ->assertRedirect(route('home'))
//            ;
//
//            $this->assertDatabaseHas('users', ['email' => 'john@johnjackson.me.uk']);
//        }
//
//        /**
//         * @test
//         * @dataProvider  registrationTestData
//         */
//        public function check_for_required_field_messages($formInput, $formValue)
//        {
//            $response = $this->post(route('register'), [
//                $formInput => $formValue,
//            ]);
//            $response->assertStatus(302)->assertSessionHasErrors($formInput);
//        }
//
//        public function registrationTestData()
//        {
//            return [
//                'Forename is required' => ['forename', ''],
//                'Surname is required' => ['surname', ''],
//                'email is required' => ['email', ''],
//                'email should be valid' => ['email', 'invalid-email'],
//                'Password is required' => ['password', ''],
//       //         'Password confirmation is required' => ['password_confirmation', ''],
//            ];
//        }

        /**
         * @test
         */
        public function the_login_page_displays_ok()
        {
            $this->get(route('login'))
                ->assertOk()
                ->assertViewIs('auth.login');
        }

        /**
         * @test
         */
        public function a_basic_user_can_log_in_and_sees_the_homepage()
        {
            $user = UserRoleFactory::create();
            $response = $this->post('login', [
                'email' => $user->email,
                'password' => 'password',
            ]);

            $this->assertAuthenticatedAs($user);
            $response->assertRedirect(route('dashboard.home'));
        }

        /**
         * @test
         */
        public function an_advanced_user_can_log_in_and_sees_the_dashboard()
        {
            $user = UserRoleFactory::withRole('advanced')->withPermissions(['see.dashboard'])->create();

            $response = $this->post('login', [
                'email' => $user->email,
                'password' => 'password',
            ]);

            $this->assertAuthenticatedAs($user);
            $response->assertRedirect(route('dashboard.home'));
        }

        /**
         * @test
         */
        public function a_user_cannot_view_the_login_form_when_logged_in()
        {
            $user = User::factory()->make();
            $response = $this->actingAs($user)->get(route('login'));
            $response->assertRedirect(route('dashboard.home'));
        }

        /**
         * @test
         */
        public function a_user_can_log_out()
        {
            $user = UserRoleFactory::create();
            $this->signIn($user);
            $this->assertAuthenticatedAs($user);
            $this->post(route('logout'));
            $this->assertGuest();
        }
    }
