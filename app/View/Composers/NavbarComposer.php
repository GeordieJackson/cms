<?php
    
    namespace App\View\Composers;
    
    use Facades\App\Actions\Posts\BuildActiveTemporalNames;
    use Facades\App\Actions\Posts\BuildMenuAction;
    use Facades\App\Actions\Posts\BuildPages;
    use Facades\App\Services\MenuBuilder;
    use Illuminate\Support\Facades\Cache;
    use Illuminate\View\View;
    
    class NavbarComposer
    {
        public function compose(View $view)
        {
            $view->with([
                'pageLinks' => $this->getPageLinks(),
                'categoryMenu' => $this->getMenu(),
                'temporalLinks' => $this->getNames(),
            ]);
        }
        
        protected function getMenu()
        {
            if ( ! Cache::has('htmlMenu')) {
                BuildMenuAction::execute();
            }
            
            return Cache::get('htmlMenu');
        }
        
        protected function getNames()
        {
            if ( ! Cache::has('activeTemporalNames')) {
                BuildActiveTemporalNames::execute();
            }
            
            return Cache::get('activeTemporalNames');
        }
        
        protected function getPageLinks()
        {
            if ( ! Cache::has('pageLinks')) {
                BuildPages::execute();
            }
            
            return Cache::get('pageLinks');
        }
    }
