<?php

    namespace Tests\Feature\Acl;

    use App\Models\Acl\Role;
    use App\Models\Users\User;
    use Facades\Tests\Setup\UserRoleFactory;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Illuminate\Support\Facades\Gate;
    use Tests\TestCase;

    class AclUserTest extends TestCase
    {
        use RefreshDatabase;

        /**
         * @IMPORTANT - this test must be run before the others in here
         *
         *            There's some interference between the tests - not sure why
         *
         *            Only occurs when using mySql
         *
         * @test
         */
        public function a_user_can_detach_roles()
        {
            $this->withoutExceptionHandling();
            $roleCount = 10;
            $user = User::factory()
                ->create();
            $roles = Role::factory()
                ->count($roleCount)
                ->create();
            $user->attachRoles($roles);
            $this->assertEquals($roleCount, $user->roles->count());

            $user->detachRole($roles[1]); // Object
            $this->assertEquals($roleCount = $roleCount - 1, $user->fresh()->roles->count());

            $user->detachRoles([3, 4]); // Array ids
            $this->assertEquals($roleCount = $roleCount - 2, $user->fresh()->roles->count());

            $user->detachRoles([$roles[5], $roles[6]]); // Array of objects
            $this->assertEquals($roleCount = $roleCount - 2, $user->fresh()->roles->count());

            $collection = collect([$roles[7], $roles[8]]);
            $user->detachRoles($collection); // Collection
            $this->assertEquals($roleCount = $roleCount - 2, $user->fresh()->roles->count());
        }

        /**
         * @test
         */
        public function admin_users_can_see_the_acl_button()
        {
            $this->signInAdminUser();

            $this->get(route('dashboard.home'))
                ->assertViewIs('dashboard.index')
                ->assertSee('Acl');
        }

        /**
         * @test
         */
        public function authorized_users_can_see_the_acl_button()
        {
            $user = UserRoleFactory::withRole('testRole')
                ->withPermissions(['manage.acl', 'see.dashboard'])
                ->create();
            $this->signIn($user);

            $this->get(route('dashboard.home'))
                ->assertViewIs('dashboard.index')
                ->assertSee('Acl');
        }

        /**
         * @test
         */
        public function unauthorized_users_can_not_see_the_acl_button()
        {
            $user = UserRoleFactory::withRole('testRole')
                ->withPermissions(['see.dashboard'])
                ->create();
            $this->signIn($user);

            $this->get(route('dashboard.home'))
                ->assertViewIs('dashboard.index')
                ->assertDontSee('Acl');
        }

        /**
         * @test
         */
        public function a_user_can_be_assigned_a_role()
        {
            $user = User::factory()
                ->create();
            $role = Role::factory()
                ->create();

            $user->attachRole($role);
            $this->assertEquals(1, $user->roles->count());
            $this->assertEquals($user->roles->first()->name, $role->name);
        }

        /**
         * @test
         */
        public function a_user_can_be_assigned_multiple_roles()
        {
            $user = User::factory()
                ->create();
            $roles = Role::factory()->count(3)->create();

            $user->attachRoles($roles);
            $this->assertEquals(3, $user->roles->count());
        }

        /**
         * @test
         */
        public function a_user_can_sync_roles()
        {
            $user = User::factory()
                ->create();
            $roles = Role::factory()->count(3)->create();
            $user->attachRoles($roles);
            $this->assertEquals(3, $user->roles->count());
            $roles->forget(1);
            $user->syncRoles($roles);
            $this->assertEquals(2, $user->fresh()->roles->count());
        }

        /**
         * @test
         */
        public function check_a_user_with_a_permission_returns_true()
        {
            $user = UserRoleFactory::withRole('role')
                ->withPermissions(['name' => 'permission'])
                ->create();
            $this->signIn($user);

            $this->assertTrue($user->can('permission'));
            $this->assertTrue(Gate::allows('permission'));
        }

        /**
         * @test
         */
        public function check_a_user_without_a_permission_returns_false()
        {
            $user = UserRoleFactory::withRole('role')
                ->withPermissions(['name' => 'permission'])
                ->create();
            $this->signIn($user);

            $this->assertFalse($user->can('lacks.permission'));
            $this->assertFalse(Gate::allows('lacks.permission'));
        }

        /**
         * @test
         */
        public function admin_users_bypass_permissions_checks_other_users_do_not()
        {
            $user = UserRoleFactory::withRole('not-an_admin')
                ->create();
            $this->assertFalse($user->can('not-set'));

            $admin = UserRoleFactory::withRole('admin')
                ->create();
            $this->assertTrue($admin->can('not-set'));
        }
    }
