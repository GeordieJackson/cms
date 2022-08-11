<?php

    namespace App\Http\Controllers\Frontend;

    use App\Http\Controllers\Controller;
    use App\Models\Posts\Post;

    class CategorizedController extends Controller
    {
        protected $pageType = 'categorized';

        public function index()
        {
            $posts = Post::withoutGlobalScope('restricted')->allCategorized()->get();

            return view('public.categorized.index', compact('posts'));
        }
    }
