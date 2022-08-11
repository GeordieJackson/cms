<?php
    
    namespace App\Http\Controllers\Backend\Tags;
    
    use App\Http\Controllers\Controller;
    use App\Models\Acl\ExtractIds;
    use App\Models\Posts\Post;
    use Facades\App\Models\Tags\Tag;
    use Facades\App\Services\Breadcrumb;
    use Illuminate\Http\Request;
    use Illuminate\Support\Str;
    use stdClass;
    
    use function abort_unless;
    use function collect;
    use function explode;
    use function ucfirst;
    use function view;
    
    class TagController extends Controller
    {
        use ExtractIds;
        
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $tags = Tag::orderBy('slug')->get();
            abort_unless($tags->count(), 404);
            $meta = new stdClass();
            $meta->title = "List of tags";
            
            return view('front.pages.tags.index')->with([
                'meta' => $meta,
                'tags' => $tags,
                'breadcrumb' => Breadcrumb::fromString('tags'),
            ]);
        }
        
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            //
        }
        
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Post $post, Request $request)
        {
            if (empty($request->input('tags'))) {
                return;
            }
            
            $tagData = collect(explode(",", $request->input('tags')))
                ->reject(fn($tag) => empty(trim($tag)))
                ->map(fn($tag) => ['name' => ucfirst(trim($tag)), 'slug' => Str::slug($tag)]);
            
            $tags = $tagData->map(fn($tag) => Tag::firstOrCreate(['name' => $tag['name']], ['slug' => $tag['slug']]));
            $post->tags()
                ->sync($this->extractIdsFrom($tags));
        }
        
        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($slug)
        {
            $tag = Tag::whereSlug($slug)->firstOrFail();
            
            $posts = Post::published()
                ->whereHas('tags', function ($q) use ($slug) {
                    $q->where('slug', $slug);
                })
                ->whereHas('temporal', function ($q) {
                    $q->whereActive(1);
                })
                ->orderByDesc('publication_date')
                ->paginate(config('settings.paginate'));
            
            $meta = new stdClass();
            $meta->title = "Article list by tag: " . $tag->name;
            
            return view('front.pages.tags.show')
                ->with(
                    [
                        'meta' => $meta,
                        'posts' => $posts,
                        'tagName' => $tag->name,
                        'breadcrumb' => Breadcrumb::fromTag($tag),
                        'tagCloud' => Tag::activeTags(),
                    ]);
        }
        
        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            //
        }
        
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            //
        }
        
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            //
        }
    }
