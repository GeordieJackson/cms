<?php

    namespace Tests\Feature\Acl;

    use App\Models\Acl\Permission;
    use App\Models\Acl\Role;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;

    class AssignmentsTest extends TestCase
    {
        use RefreshDatabase;

        /**
         * @test
         */
        public function an_authorized_user_can_see_the_index_page()
        {
            $this->signInAdminUser();

            $this->get(route('dashboard.assign.index'))
                ->assertViewIs('dashboard.assignments.index')
                ->assertViewHas('roles');
        }

        /**
         * @test
         */
        public function an_unauthorized_user_can_not_see_the_index_page()
        {
            $this->signIn();

            $this->get(route('dashboard.assign.index'))
                ->assertStatus(403);
        }

        /**
         * @test
         */
        public function an_authorized_user_can_update_permissions_for_a_role()
        {
            $this->signInAdminUser();

            $role = Role::factory()->create(['slug' => 'test-role', 'name' => 'Test Role']);
            $p1 = Permission::factory()->create(['name' => 'test.one']);
            $p2 = Permission::factory()->create(['name' => 'test.two']);
            $p3 = Permission::factory()->create(['name' => 'test.three']);
            $p4 = Permission::factory()->create(['name' => 'test.four']);
            $p5 = Permission::factory()->create(['name' => 'test.five']);

            $this->put(route('dashboard.assign.update', $role->id), [
                'role_ids' => [$p2->id, $p4->id, $p5->id]
            ]);

            $this->assertFalse($role->permissions->pluck('name')->contains('test.one'));
            $this->assertTrue($role->permissions->pluck('name')->contains('test.two'));
            $this->assertFalse($role->permissions->pluck('name')->contains('test.three'));
            $this->assertTrue($role->permissions->pluck('name')->contains('test.four'));
            $this->assertTrue($role->permissions->pluck('name')->contains('test.five'));
        }
    }
