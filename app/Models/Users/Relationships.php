<?php
    
    namespace App\Models\Users;
    
    use App\Models\Acl\Role;
    use App\Models\Posts\Post;

    trait Relationships
    {
        public function posts()
        {
            return $this->hasMany(Post::class, 'owner_id');
        }
        
        public function roles()
        {
            return $this->belongsToMany(Role::class);
        }
        
        public function hasRole($targetRole): bool
        {
            if (is_string($targetRole)) {
                return $this->roles->contains('slug', $targetRole);
            }

            return !! $this->roles->intersect($targetRole)->count();
        }
        
        public function syncRoles($roles)
        {
            $this->roles()->sync($this->extractIdsFrom($roles));
        }
        
        public function attachRole($role)
        {
            $this->attachRoles($role);
        }
        
        public function attachRoles($roles)
        {
            $this->roles()->attach($this->extractIdsFrom($roles));
        }
        
        public function detachRole($role)
        {
            $this->detachRoles($role);
        }
        
        public function detachRoles($roles)
        {
            $this->roles()->detach($this->extractIdsFrom($roles));
        }
    }
