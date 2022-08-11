<?php

    namespace Tests\Feature\Acl;

    use App\Models\Acl\Permission;
    use App\Models\Acl\Role;
    use App\Models\Users\User;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;

    class RolesTest extends TestCase
    {
        use RefreshDatabase;

        /**
         * @test
         */
        public function a_role_can_attach_permissions()
        {
            $role = Role::factory()->create();

            // Attach a single permission
            $newPermission = Permission::factory()->create();
            $role->attachPermission($newPermission);
            $this->assertEquals(1, $role->fresh()->permissions->count());

            // Attach multiple permissions at once
            $newPermissions = Permission::factory()->count(3)->create();
            $role->attachPermissions($newPermissions);
            $this->assertEquals(4, $role->fresh()->permissions->count());
        }

        /**
         * @test
         */
        public function a_role_can_sync_permissions()
        {
            $role = Role::factory()->create();
            $permissions = Permission::factory()->count(5)->create();
            $role->syncPermissions($permissions);
            $this->assertEquals(5, $role->permissions->count());

            $permissions->forget(0)->forget(2);
            $role->syncPermissions($permissions);

            $this->assertEquals(3, $role->fresh()->permissions->count());
        }

        /**
         * @test
         */
        public function a_role_can_detach_permissions()
        {
            $role = Role::factory()->create();
            $permissions = Permission::factory()->count(10)->create();
            $role->attachPermissions($permissions);

            // Detach a single permission by Id
            $role->detachPermission($permissions[0]->id);
            $this->assertEquals(9, $role->fresh()->permissions->count());

            // Detach a single permission via object
            $role->detachPermission($permissions[2]);
            $this->assertEquals(8, $role->fresh()->permissions->count());

            // Detach multiple permissions by array of Ids
            $role->detachPermissions([$permissions[5]->id, $permissions[6]->id]);
            $this->assertEquals(6, $role->fresh()->permissions->count());

            // Detach multiple permissions via array of objects
            $role->detachPermissions([$permissions[1], $permissions[7]]);
            $this->assertEquals(4, $role->fresh()->permissions->count());
        }

        /**
         * @test
         */
        public function a_role_can_belong_to_a_user()
        {
            $user = User::factory()->create();
            $role = Role::factory()->create();
            $user->attachRole($role);

            $this->assertEquals(1, $role->users->count());
            $this->assertEquals($role->users->first()->name, $user->name);
        }
    }
