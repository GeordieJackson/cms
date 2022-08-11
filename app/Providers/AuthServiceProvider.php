<?php
    
    namespace App\Providers;
    
    use App\Models\Acl\Permission;
    use App\Models\Team;
    use App\Policies\TeamPolicy;
    use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
    use Illuminate\Support\Facades\Gate;
    
    use function app;
    
    class AuthServiceProvider extends ServiceProvider
    {
        /**
         * The policy mappings for the application.
         *
         * @var array
         */
        protected $policies = [
            Team::class => TeamPolicy::class,
        ];
        
        /**
         * Register any authentication / authorization services.
         *
         * @return void
         */
        public function boot()
        {
            $this->registerPolicies();
            
            Gate::before(
                function ($user) {
                    if ($user->hasRole('admin')) {
                        return true;
                    }
                }
            );
            
            if (!app()->runningInConsole()) { // This check prevents problems when testing
                Permission::with('roles')->get()->each(
                    function ($permission) {
                        Gate::define(
                            $permission->name,
                            function ($user) use ($permission) {
                                return $user->hasRole($permission->roles);
                            }
                        );
                    }
                );
            };
        }
    }
