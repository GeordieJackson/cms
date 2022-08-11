<?php

    namespace Tests\Feature\Backend\Dashboard\Acl;

    use App\Models\Acl\Role;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;

    class RolesTest extends TestCase
    {
        use RefreshDatabase;

        /**
         * @test
         */
        public function the_index_page_shows_a_list_of_all_roles()
        {
            $this->signInAdminUser();

            $this->get(route('dashboard.roles.index'))->assertViewIs('dashboard.roles.index')->assertViewHas('roles');
        }

        /**
         * @test
         */
        public function authorized_users_can_add_a_role()
        {
            $this->signInAdminUser();

            $this->post(route('dashboard.roles.store'), [
                'slug' => 'test-role',
                'name' => 'Test Role',
                'description' => 'This is a test role',
            ]);

            $this->assertDatabaseHas('roles', ['slug' => 'test-role']);
        }

        /**
         * @test
         */
        public function unauthorized_users_cannot_add_a_role()
        {
            $this->signIn();

            $this->post(route('dashboard.roles.store'), [
                'slug' => 'test-role',
                'name' => 'Test Role',
                'description' => 'This is a test role',
            ])->assertStatus(403);
        }

        /**
         * @test
         */
        public function authorized_users_can_update_a_role()
        {
            $this->signInAdminUser();

            $role = Role::factory()->create([
                'slug' => 'test-role',
                'name' => 'Test Role',
                'description' => 'This is a test role',
            ]);

            $this->put(route('dashboard.roles.update', $role->id), [
                'slug' => 'test-role-updated',
                'name' => 'Test Role',
                'description' => 'This is a test role',
            ]);

            $this->assertDatabaseMissing('roles', ['slug' => 'test-role']);
            $this->assertDatabaseHas('roles', ['slug' => 'test-role-updated']);
        }

        /**
         * @test
         */
        public function unauthorized_users_cannot_update_a_role()
        {
            $this->signIn();

            $role = Role::factory()->create([
                'slug' => 'test-role',
                'name' => 'Test Role',
                'description' => 'This is a test role',
            ]);

            $this->put(route('dashboard.roles.update', $role->id), [
                'slug' => 'test-role-updated',
                'name' => 'Test Role',
                'description' => 'This is a test role',
            ])->assertStatus(403);
        }

        /**
         * @test
         */
        public function an_authorized_user_can_delete_a_role()
        {
            $this->signInAdminUser();

            $role = Role::factory()->create(['slug' => 'test-role']);

            $this->delete(route('dashboard.roles.destroy', $role->id));
            $this->assertDatabaseMissing('roles', ['slug' => 'test-role']);
        }

        /**
         * @test
         */
        public function an_unauthorized_user_can_not_delete_a_role()
        {
            $this->signIn();

            $role = Role::factory()->create();

            $this->delete(route('dashboard.roles.destroy', $role->id))->assertStatus(403);
        }

        /*------------------------------------------ Validation ----------------------------------------------*/

        /**
         * @test
         * @dataProvider  rolesValidationTestData
         */
        public function check_for_role_error_messages($key, $value)
        {
            $this->signInAdminUser();

            $response = $this->post(route('dashboard.roles.store'), [
                $key => $value,
            ]);

            $response->assertStatus(302)->assertSessionHasErrors($key);
        }

        /**
         * @return array
         */
        public function rolesValidationTestData()
        {
            return [
                ['name', ''],
                ['slug', ''],
            ];
        }

        /**
         * @test
         */
        public function a_null_description_gets_defaulted_to_an_empty_string()
        {
            $this->signInAdminUser();

            $this->post(route('dashboard.roles.store'), [
                'slug' => 'test-role',
                'name' => 'Test Role',
                'description' => null,
            ]);

            $this->assertDatabaseHas('roles', ['description' => '']);
        }

        /**
         * @test
         */
        public function a_missing_description_gets_defaulted_to_an_empty_string()
        {
            $this->signInAdminUser();

            $this->post(route('dashboard.roles.store'), [
                'slug' => 'test-role',
                'name' => 'Test Role',
            ]);

            $this->assertDatabaseHas('roles', ['description' => '']);
        }
    }
