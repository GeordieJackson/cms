<?php
    
    namespace App\Http\Controllers\Backend;
    
    use App\Http\Controllers\Controller;
    use App\Models\Categories\Category;
    use App\Models\Posts\Post;
    use App\Models\Users\User;
    
    class DashboardController extends Controller
    {
        public function index()
        {
            $categoriesCount = Category::count();
            $postCount = Post::where('type', "!=", 3)->count();
            $activePostCount = Post::where('type', "!=", 3)->published()->count();
            $userCount = User::count();

            return view('dashboard.index')->with(\compact( 'categoriesCount', 'postCount', 'activePostCount', 'userCount'));
        }
    }
