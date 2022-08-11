<?php

    namespace App\Providers;

    use App\View\Composers\NavbarComposer;
    use App\View\Composers\TagCloudComposer;
    use Illuminate\Support\Facades\View;
    use Illuminate\Support\ServiceProvider;

    class ViewServiceProvider extends ServiceProvider
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
            View::composer('front.pages.partials.navbar', NavbarComposer::class);
            //  View::composer('themes.'.config('theme.name').'.partials.display', MenuComposer::class);
        }
    }
