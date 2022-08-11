<?php
    
    namespace App\Http\Controllers\Frontend;
    
    use App\Http\Controllers\Controller;
    use App\Models\Posts\Post;
    use Facades\App\Services\Breadcrumb;
    
    use function view;
    
    class HomeController extends Controller
    {
        public function __invoke()
        {
            $latestPosts = Post::filtered()
                ->published()
                ->orderByDesc('sticky')
                ->orderByDesc('publication_date')
                ->take(6)
                ->get();
            
            $content = Post::whereSlug('index')->first();
            
            return view('front.pages.static.index')->with([
                //   'breadcrumb' => Breadcrumb::homepage(),
                'latestPosts' => $latestPosts,
                'content' => $content,
            ]);
        }
    }