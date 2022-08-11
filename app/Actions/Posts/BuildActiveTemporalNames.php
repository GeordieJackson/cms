<?php
    
    namespace App\Actions\Posts;
    
    use App\Models\TemporalNames\TemporalName;
    use Illuminate\Support\Facades\Cache;
    
    class BuildActiveTemporalNames
    {
        public function execute()
        {
            $links = TemporalName::activeTemporalNames()->get();
            
            $activeTemporalNames = '';
            
            foreach ($links as $link) {
               $activeTemporalNames .= "<li><a href=\"/$link->slug\">" . display($link->name, 'f') . "</a></li>\n";
            }
            
            Cache::put('activeTemporalNames', $activeTemporalNames);
        }
    }