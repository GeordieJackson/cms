<?php

    namespace App\Actions\Posts;

    use Carbon\Carbon;
    use App\Models\Posts\Post;
    use Illuminate\Support\Facades\DB;
    use Facades\App\Models\Categories\Category;

    class SetCategorizedPostCounts
    {
        public function execute()
        {
            $postCounts = Post::select('category_id', DB::raw('COUNT(*) as count'))
                ->where('category_id', ">", 0)
                ->where('type', Post::CATEGORIZED)
                ->where('published', 1)
                ->where('publication_date', "<=", Carbon::now())
                ->groupBy('category_id')
                ->get()
                ->pluck('count', 'category_id')
            ;

            Category::where('id', ">", 0)->update(['count' => 0]);

            $postCounts->each(fn($count, $key) => Category::whereId($key)->update(['count' => $count]));
        }
    }
