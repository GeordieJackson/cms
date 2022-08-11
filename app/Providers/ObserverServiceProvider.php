<?php

    namespace App\Providers;

    use App\Models\Categories\Category;
    use App\Models\Posts\Post;
    use App\Models\TemporalNames\TemporalName;
    use App\Models\Users\User;
    use App\Observers\CategoryObserver;
    use App\Observers\PostObserver;
    use App\Observers\TemporalNamesObserver;
    use App\Observers\UserObserver;
    use Illuminate\Support\ServiceProvider;

    class ObserverServiceProvider extends ServiceProvider
    {
        /**
         * Register services.
         *
         * @return void
         */
        public function register()
        {
            //
        }

        /**
         * Bootstrap services.
         *
         * @return void
         */
        public function boot()
        {
            Post::observe(PostObserver::class);
            Category::observe(CategoryObserver::class);
            User::observe(UserObserver::class);
            TemporalName::observe(TemporalNamesObserver::class);
        }
    }
