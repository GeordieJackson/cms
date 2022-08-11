<?php
    
    namespace App\Http\Controllers\Frontend;
    
    use App\Http\Controllers\Controller;
    use App\Models\Posts\Post;
    use App\Models\TemporalNames\TemporalName;
    use App\Presenters\Posts\TemporalPresenter;
    use Facades\App\Models\Tags\Tag;
    use Facades\App\Services\Breadcrumb;

    use function abort_if;
    use function abort_unless;
    use function config;
    use function deslugify;
    use function strtolower;
    use function ucwords;
    use function view;
    
    class TemporalController extends Controller
    {
        /**
         * @param $temporalName
         * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function index($temporalName)
        {
            $this->checkIfActive($temporalName);
            
            $posts = Post::allTemporalFront($temporalName)->paginate(config('settings.paginate'));
            $breadcrumb = Breadcrumb::fromString($temporalName);
            $tagCloud = Tag::activeTags();
            $temporalName = ucwords(strtolower(deslugify($temporalName)));
            
            return view('front.pages.temporal.index', compact('posts', 'temporalName', 'breadcrumb', 'tagCloud'));
        }
        
        /**
         * @param $temporalName
         * @param $slug
         * @return \App\Presenters\Posts\TemporalPresenter
         */
        public function show($temporalName, $slug)
        {
            $post = Post::blogEntry($temporalName, $slug)->firstOrFail();
            
            return new TemporalPresenter($post);
        }
        
        protected function checkIfActive($temporalName): void
        {
            abort_unless(TemporalName::whereSlug($temporalName)->exists(), 404);
            abort_if(TemporalName::whereSlug($temporalName)->value('active') == 0, 404);
            
            abort_if( ! TemporalName::whereSlug($temporalName)->withCount([
                'posts' => function ($q) {
                    $q->published();
                },
            ])->value('posts_count'), 404);
        }
    }
