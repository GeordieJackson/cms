<?php
    
    namespace App\Http\Controllers\Frontend;
    
    use App\Http\Controllers\Controller;
    use App\Models\Categories\Category;
    use App\Models\Posts\Post;
    use Facades\App\Services\Breadcrumb;
    use Facades\App\Services\MenuBuilder;

    use function abort_unless;
    use function deslugify;
    use function display;
    use function dump;
    use function ucfirst;
    use function ucwords;
    
    class CategoriesController extends Controller
    {
        public function index()
        {
            $categories = Category::with('parents')->activeCategories();
            abort_unless($categories->count(), 404);
            $breadcrumb = Breadcrumb::fromString('categories');
            
            return view('front.pages.categories.index')->with([
                'categories' => $categories, 'breadcrumb' => $breadcrumb,
            ]);
        }
        
        public function show($category)
        {
            $posts = Post::postsInCategory($category)->paginate();
            $subCategories = MenuBuilder::htmlMenu($category);
            
            if($posts->count()) {
                $breadcrumb = Breadcrumb::fromCategory($posts->first()->category);
            } else {
                $breadcrumb = Breadcrumb::fromString($category);
            }
            
            return view('front.pages.categories.show')->with([
                'posts' => $posts,
                'category' => display(deslugify($category), 'w'),
                'breadcrumb' => $breadcrumb,
                'subCategories' => $subCategories
            ]);
        }
    }
