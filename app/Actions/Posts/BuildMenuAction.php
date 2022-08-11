<?php
    
    namespace App\Actions\Posts;
    
    use Facades\App\Services\MenuBuilder;
    use Illuminate\Support\Facades\Cache;
    
    class BuildMenuAction
    {
        public function execute()
        {
            $menu = MenuBuilder::htmlMenu();
            
            Cache::put('htmlMenu', $menu);
        }
    }