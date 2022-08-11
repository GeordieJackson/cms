<?php

    namespace Tests\Feature\Acl;

    use App\Models\Acl\Permission;
    use App\Models\Acl\Role;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;

    class PermissionsTest extends TestCase
    {
        use RefreshDatabase;

        /*------------------------------------------ Validation ----------------------------------------------*/

        /**
         * @test
         * @dataProvider  permissionsValidationTestData
         */
        public function check_for_permission_error_messages($key, $value)
        {
            $this->signInAdminUser();

            $response = $this->post(route('dashboard.permissions.store'), [
                $key => $value,
            ]);

            $response->assertStatus(302)
                ->assertSessionHasErrors($key);
        }

        /**
         * @return array
         */
        public function permissionsValidationTestData()
        {
            return [
                ['name', ''],
            ];
        }

        /*--------------------------------------------------------------------------------------------------*/

        /**
         * @test
         */
        public function the_index_page_shows_a_list_of_all_permissions()
        {
            $this->signInAdminUser();

            $this->get(route('dashboard.permissions.index'))
                ->assertViewIs('dashboard.permissions.index')
                ->assertViewHas('permissions');
        }

        /**
         * @test
         */
        public function authorized_users_can_add_a_permission()
        {
            $this->signInAdminUser();

            $this->post(\route('dashboard.permissions.store'), [
                'name' => 'test.permission',
                'description' => 'This is a test permission',
            ]);

            $this->assertDatabaseHas('permissions', ['name' => 'test.permission']);
        }

        /**
         * @test
         */
        public function unauthorized_users_can_not_add_a_permission()
        {
            $this->signIn();

            $this->post(\route('dashboard.permissions.store'), [
                'name' => 'test.permission',
                'description' => 'This is a test permission',
            ])->assertStatus(403);
        }

        /**
         * @test
         */
        public function authorized_users_can_update_a_permission()
        {
            $this->signInAdminUser();

            $permission = Permission::factory()->create(['description' => 'desc original']);

            $this->put(route('dashboard.permissions.update', $permission->id), [
                'name' => 'new name',
                'description' => 'This is a test permission',
            ]);

            $this->assertDatabaseMissing('permissions', ['description' => 'desc original']);
            $this->assertDatabaseHas('permissions', ['description' => 'This is a test permission']);
        }

        /**
         * @test
         */
        public function unauthorized_users_can_not_update_a_permission()
        {
            $this->signIn();

            $permission = Permission::factory()->create(['name' => 'name', 'description' => 'desc original']);

            $this->put(route('dashboard.permissions.update', $permission->id), [
                'name' => 'new name',
                'description' => 'This is a test permission',
            ])->assertStatus(403);
        }

        /**
         * @test
         */
        public function an_authorized_user_can_delete_a_permission()
        {
            $this->signInAdminUser();

            $permission = Permission::factory()->create(['name' => 'test perm']);

            $this->delete(route('dashboard.permissions.destroy', $permission->id));
            $this->assertDatabaseMissing('permissions', ['name' =>'test perm']);
        }

        /**
         * @test
         */
        public function an_unauthorized_user_can_not_delete_a_permission()
        {
            $this->signIn();

            $permission = Permission::factory()->create();

            $this->delete(route('dashboard.permissions.destroy', $permission->id))->assertStatus(403);
        }

        /**
         * @test
         */
        public function a_permission_can_belong_to_a_role()
        {
            $role = Role::factory()->create(['name' => 'test-role']);
            $permission = Permission::factory()->create();
            $role->attachPermission($permission);

            $this->assertEquals($role->name, $permission->roles->first()->name);
        }

        /**
         * @test
         */
        public function a_permission_can_belong_to_more_than_one_role()
        {
            $roles = Role::factory()->count(3)->create();
            $permission = Permission::factory()->create();

            $roles->each(function($role) use ($permission) {
                $role->attachPermission($permission);
            });

            $this->assertEquals(3, $permission->roles->count());
        }
    }
