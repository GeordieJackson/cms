<?php

    namespace Tests\Feature\Backend\Dashboard\Users;

    use App\Models\Acl\Role;
    use App\Models\Users\User;
    use Facades\Tests\Setup\UserRoleFactory;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;

    use function factory;
    use function route;

    class UserManagementTest extends TestCase
    {
        use RefreshDatabase;

        protected $author;
        protected $editor;

        protected function setUp() : void
        {
            parent::setUp();

            $this->author = UserRoleFactory::withRole('author')->withPermissions('see.dashboard')->create();
            $this->editor = UserRoleFactory::withRole('editor')
                                           ->withPermissions(['see.dashboard', 'manage.users',])
                                           ->create();
        }

        /**
         * @test
         */
        public function authorized_users_can_see_the_users_button()
        {
            $this->signInAdminUser();
            $response = $this->get(route('dashboard.home'));
            $response->assertSee('Users');
        }

        /**
         * @test
         */
        public function unauthorized_users_can_not_see_the_users_button()
        {
            $this->signIn($this->author);
            $response = $this->get(route('dashboard.home'));
            $response->assertDontSee('Users');
        }

        /**
         * @test
         */
        public function authorized_users_see_the_index_page()
        {
            $this->signInAdminUser();
            $response = $this->get(route('dashboard.users.index'));
            $response->assertViewIs('dashboard.users.index');
        }

        /**
         * @test
         */
        public function unauthorized_users_do_not_see_the_index_page()
        {
            $this->signIn($this->author);
            $response = $this->get(route('dashboard.users.index'));
            $response->assertStatus(403);
        }

        /**
         * @test
         */
        public function authorized_users_see_all_users()
        {
            User::factory()->count(5)->create();
            $this->signInAdminUser();
            $response = $this->get(route('dashboard.users.index'));
            $this->assertEquals(8, $response->viewData('users')->count());
        }

        /**
         * @test
         */
        public function authorized_users_can_edit_all_users()
        {
            $this->signInAdminUser();

            $response = $this->get(route('dashboard.users.edit', $this->author->id))->assertViewIs(
                'dashboard.users.edit'
            );
            
            $this->assertTrue($response->viewData('user')->roles->contains(Role::whereSlug('author')->value('id')));

            $response = $this->get(route('dashboard.users.edit', $this->editor->id))->assertViewIs(
                'dashboard.users.edit'
            );
            $this->assertTrue($response->viewData('user')->roles->contains(Role::whereSlug('editor')->value('id')));
        }

        /**
         * @test
         */
        public function restricted_users_can_only_edit_their_own_profile()
        {
            $this->signIn($this->author);

            $response = $this->get(route('dashboard.users.edit', $this->author->id))->assertViewIs(
                'dashboard.users.edit'
            );
            $this->assertTrue($response->viewData('user')->roles->contains(Role::whereSlug('author')->value('id')));

            $this->get(route('dashboard.users.edit', $this->editor->id))->assertStatus(403);
        }

        /**
         * @test
         */
        public function restricted_users_can_update_their_own_profile()
        {
            $this->signIn($this->author);

            $this->patch(
                route('dashboard.users.update', $this->author->id),
                [
                    'forename' => 'Wilhelm',
                    'surname' => 'Mooster',
                    'email' => 'willie@mooster.com',
                    'roles' => 2
                ]
            );
            $this->assertDatabaseHas('users', ['forename' => 'Wilhelm']);

            $response = $this->get(route('dashboard.users.edit', $this->author->id));
            $response->assertSee('Wilhelm');
        }

        /**
         * @test
         */
        public function restricted_users_can_not_update_anothers_profile()
        {
            $this->signIn($this->author);

            $this->patch(
                route('dashboard.users.update', $this->author->id + 1),
                [
                    'forename' => 'Wilhelm',
                    'surname' => 'Mooster',
                    'email' => 'willie@mooster.com',
                    'roles' => 2
                ]
            )->assertStatus(403);
            $this->assertDatabaseMissing('users', ['forename' => 'Wilhelm']);
        }

        /**
         * @test
         */
        public function authorized_users_can_update_anothers_profile()
        {
            $this->signInAdminUser();

            $this->patch(
                route('dashboard.users.update', $this->author->id),
                [
                    'forename' => 'Wilhelm',
                    'surname' => 'Mooster',
                    'email' => 'willie@mooster.com',
                    'roles' => 2
                ]
            );

            $this->assertDatabaseHas('users', ['forename' => 'Wilhelm']);
            $response = $this->get(route('dashboard.users.edit', $this->author->id));
            $response->assertSee('Wilhelm');
        }

        /**
        * @test
        */
        public function the_slug_is_created_from_the_forename_and_surname_fields()
        {
            $this->signInAdminUser();

            $this->patch(
                route('dashboard.users.update', $this->author->id),
                [
                    'forename' => 'Wilhelm',
                    'surname' => 'Mooster',
                    'email' => 'willie@mooster.com',
                    'roles' => 2
                ]
            );

            $this->assertDatabaseHas('users', ['slug' => 'wilhelm-mooster']);
        }

        /*------------------------------------------ Validation ----------------------------------------------*/

        /**
         * @test
         * @dataProvider  userValidationTestData
         */
        public function check_for_permission_error_messages($key, $value)
        {
            $this->signInAdminUser();

            $response = $this->patch(route('dashboard.users.update', $this->author->id), [
                $key => $value,
            ]);

            $response->assertStatus(302)->assertSessionHasErrors($key);
        }

        /**
         * @return array
         */
        public function userValidationTestData()
        {
            return [
                ['forename', ''],
                ['surname', ''],
                ['email', ''],
            ];
        }

        /*--------------------------------------------------------------------------------------------------*/
    }
