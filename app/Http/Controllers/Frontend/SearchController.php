<?php
    
    namespace App\Http\Controllers\Frontend;
    
    use App\Http\Controllers\Controller;

    use function request;
    use function view;

    class SearchController extends Controller
    {
        public function index()
        {
            $searchTerm = request()->input('searchTerm');
            
            return view('front.pages.search.index')->with('searchTerm', $searchTerm);
        }
    }