<?php
    
    namespace App\Providers;
    
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Support\ServiceProvider;

    use function app;

    class AppServiceProvider extends ServiceProvider
    {
        /**
         * Register any application services.
         *
         * @return void
         */
        public function register()
        {
            //
        }
        
        /**
         * Bootstrap any application services.
         *
         * @return void
         */
        public function boot()
        {
            Schema::defaultStringLength(191); // For Maria DB
            Model::preventLazyLoading( ! app()->isProduction());

//            Paginator::defaultView('pagination.pagination');
//            Paginator::defaultSimpleView('pagination.pagination');
        }
    }
