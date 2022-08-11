<?php

    namespace Tests\Feature\Backend\Dashboard;

    use Facades\Tests\Setup\UserRoleFactory;
    use Illuminate\Auth\AuthenticationException;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;

    class DashboardTest extends TestCase
    {
        use RefreshDatabase;

        /**
         * @test
         */
        public function unregistered_users_cannot_see_the_dashboard()
        {
            $this->withoutExceptionHandling();
            $this->expectException(AuthenticationException::class);
            $this->get('dashboard');
        }

        /**
         * @test
         */
        public function registered_users_with_permission_can_see_the_dashboard()
        {
            $user = UserRoleFactory::withRole('role')->withPermissions(['name' => 'see.dashboard'])->create();
            $this->signIn($user);
            $this->get('dashboard')
                ->assertStatus(200)
                ->assertViewIs('dashboard.index');
        }

        /**
         * @test
         */
        public function registered_users_without_permission_get_redirected_to_the_homepage()
        {
            $user = UserRoleFactory::withRole('role')->withPermissions(['name' => 'cannot.see.dashboard'])->create();
            $response = $this->post('login', [
                'email' => $user->email,
                'password' => $user->password
            ]);

            $response->assertStatus(302)
                ->assertRedirect(\route('home'));
        }
    }
