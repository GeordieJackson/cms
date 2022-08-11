<?php

    namespace App\View\Composers;

    use Illuminate\View\View;
    use Facades\App\Services\MenuBuilder;

    class MenuComposer
    {
        public function compose(View $view)
        {
            $view->with([
      //          'categoryMenu' => MenuBuilder::htmlMenu(),
            ]);
        }
    }
