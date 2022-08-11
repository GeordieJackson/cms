<?php

    namespace App\Models\Acl;

    use App\Models\Users\User;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Role extends Model
    {
        use HasFactory;

        protected $fillable = ['slug', 'name', 'description'];

        use ExtractIds;

        public function users()
        {
            return $this->belongsToMany(User::class);
        }

        public function permissions()
        {
            return $this->belongsToMany(Permission::class);
        }

        public function syncPermissions($permissions)
        {
            $this->permissions()->sync($this->extractIdsFrom($permissions));
        }

        public function attachPermission($permission)
        {
            $this->attachPermissions($permission);
        }

        public function attachPermissions($permissions)
        {
            $this->permissions()->attach($this->extractIdsFrom($permissions));
        }

        public function detachPermission($permission)
        {
            $this->detachPermissions($permission);
        }

        public function detachPermissions($permissions)
        {
            $this->permissions()->detach($this->extractIdsFrom($permissions));
        }

        public function scopeWithoutAdmin($query)
        {
            return $query->where('name', "!=", "admin");
        }
    }
