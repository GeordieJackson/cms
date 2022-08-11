<?php
    
    namespace App\Http\Controllers\Backend\Posts;
    
    use App\Http\Controllers\Controller;
    use App\Http\Requests\PostRequest;
    use App\Models\Posts\Post;
    use App\Presenters\Dashboard\Posts\CreatePostPresenter;
    use App\Presenters\Dashboard\Posts\EditPostPresenter;
    use Facades\App\Http\Controllers\Backend\Tags\TagController;
    use Facades\App\Services\Flash;
    
    use function redirect;
    
    class PostsController extends Controller
    {
        public function index()
        {
            return view('dashboard.posts.index');
        }
        
        public function create()
        {
            return new CreatePostPresenter(new Post());
        }
        
        public function store(PostRequest $request)
        {
            $post = Post::create($request->validated());
            TagController::store($post, $request);
            
            return redirect()->action("\App\Http\Controllers\Backend\Posts\PostsController@index");
        }
        
        public function edit($id)
        {
            $post = $this->getPost($id);
            return new EditPostPresenter($post);
        }
        
        public function update(PostRequest $request, $id)
        {
            $post = $this->getPost($id);
            $post->fill($request->validated())->save();
            TagController::store($post, $request);
            
            if (!$post->wasChanged()) {
                Flash::info("Post '{$post->title}' was NOT updated. No changes detected.");
            };
            
            return redirect()->action("\App\Http\Controllers\Backend\Posts\PostsController@edit", $post);
        }
    
        public function destroy(Post $post)
        {
            $post->delete();
    
            return redirect()->route('dashboard.posts.index');
        }
    
        protected function getPost($id): Post
        {
            return Post::findOrFail($id);
        }
    }
