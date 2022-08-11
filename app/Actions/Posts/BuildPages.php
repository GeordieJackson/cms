<?php
    
    namespace App\Actions\Posts;
    
    use App\Models\Posts\Post;
    use Illuminate\Support\Facades\Cache;
    
    use const PHP_EOL;
    
    class BuildPages
    {
        public function execute()
        {
            $activePages = Post::activePages()->get();
            
            $pageLinks = "<li><a href=" . route('home') . ">Home</a></li>" . PHP_EOL;
            
            foreach ($activePages as $activePage) {
                $pageLinks .= "<li><a href=" . route('post',
                        $activePage->slug) . ">$activePage->title</a></li>" . PHP_EOL;
            }
            
            Cache::put('pageLinks', $pageLinks);
        }
    }