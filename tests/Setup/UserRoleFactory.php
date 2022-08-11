<?php

    namespace Tests\Setup;

    use App\Models\Acl\Permission;
    use App\Models\Acl\Role;
    use App\Models\Users\User;
    use Illuminate\Support\Arr;
    use Illuminate\Support\Facades\Gate;

    class UserRoleFactory
    {
        protected $role;
        protected $permissions = [];

        /**
         * @return mixed
         */
        public function create($attributes = [])
        {
            $user = User::factory()->create($attributes); // Remember to send bcrypt('password') to set a password (!)

            if( ! $this->role) {
                return $user;
            }

            $role = Role::factory()->create(['slug' => $this->role, 'name' => \ucfirst($this->role)]);

            foreach($this->permissions as $permissionName) {

                if(Permission::whereName($permissionName)->exists()) {
                    $permission = Permission::whereName($permissionName)->first();
                } else {
                    $permission = Permission::factory()->create(['name' => $permissionName]);
                }

                $role->attachPermission($permission);

                Gate::define($permissionName, function($user) use ($permission) {
                    return $user->hasRole($permission->roles);
                });
            }

            $user->attachRole($role);

            return $user;
        }

        /**
         * @param $name
         * @return $this
         */
        public function withRole($name)
        {
            $this->role = \strtolower($name);

            return $this;
        }

        /**
         * @param array $permissions
         * @return $this
         */
        public function withPermissions($permissions)
        {
            $this->permissions = Arr::wrap($permissions);

            return $this;
        }
    }
